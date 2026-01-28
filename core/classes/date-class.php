<?php

declare(strict_types=1);

/**
 * Calendar.php
 * - Date formatting helpers (like your snippet)
 * - Add/Subtract: time, day, week, year
 * - Timer that triggers alarm on expire (blocking; suitable for CLI/long-running requests)
 * - Outputs in JSON/HTML
 * - Month calendar rendering (HTML) and month matrix (JSON/array)
 */
class JX_Calendar
{
    private \DateTimeZone $tz;

    /** Optional event storage (simple in-memory) */
    private array $events = []; // keyed by YYYY-MM-DD => list of events

    public function __construct(string $timezone = 'UTC')
    {
        $this->tz = new \DateTimeZone($timezone);
    }

    // ---------------------------
    // Your original intent: formatting helpers
    // ---------------------------

    /** Equivalent to get_default_date($date) */
    public function getDefaultDate(string|\DateTimeInterface $date): string
    {
        return $this->formatDate($date, 'M d, Y');
    }

    /** Equivalent to format_date($input, $format) but supports DateTimeInterface too */
    public function formatDate(string|\DateTimeInterface $input, string $format): string
    {
        $dt = $this->toDateTimeImmutable($input);
        return $dt->format($format);
    }

    // ---------------------------
    // Add / Subtract features
    // ---------------------------

    public function addTime(string|\DateTimeInterface $date, int $hours = 0, int $minutes = 0, int $seconds = 0): \DateTimeImmutable
    {
        return $this->addDelta($date, ['hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds]);
    }

    public function subtractTime(string|\DateTimeInterface $date, int $hours = 0, int $minutes = 0, int $seconds = 0): \DateTimeImmutable
    {
        return $this->subtractDelta($date, ['hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds]);
    }

    public function addDays(string|\DateTimeInterface $date, int $days): \DateTimeImmutable
    {
        return $this->addDelta($date, ['days' => $days]);
    }

    public function subtractDays(string|\DateTimeInterface $date, int $days): \DateTimeImmutable
    {
        return $this->subtractDelta($date, ['days' => $days]);
    }

    public function addWeeks(string|\DateTimeInterface $date, int $weeks): \DateTimeImmutable
    {
        return $this->addDelta($date, ['days' => $weeks * 7]);
    }

    public function subtractWeeks(string|\DateTimeInterface $date, int $weeks): \DateTimeImmutable
    {
        return $this->subtractDelta($date, ['days' => $weeks * 7]);
    }

    public function addYears(string|\DateTimeInterface $date, int $years): \DateTimeImmutable
    {
        return $this->addDelta($date, ['years' => $years]);
    }

    public function subtractYears(string|\DateTimeInterface $date, int $years): \DateTimeImmutable
    {
        return $this->subtractDelta($date, ['years' => $years]);
    }

    /**
     * General add: supports years/months/days/hours/minutes/seconds (positive or negative).
     * Negative values automatically become subtract.
     */
    public function addDelta(string|\DateTimeInterface $date, array $delta): \DateTimeImmutable
    {
        $dt = $this->toDateTimeImmutable($date);

        // If any values are negative, split into add + subtract to avoid weird intervals.
        $add = [];
        $sub = [];
        foreach (['years', 'months', 'days', 'hours', 'minutes', 'seconds'] as $k) {
            $v = (int)($delta[$k] ?? 0);
            if ($v >= 0) $add[$k] = $v;
            else $sub[$k] = abs($v);
        }

        if ($this->sumDelta($add) > 0) {
            $dt = $dt->add($this->buildInterval($add));
        }
        if ($this->sumDelta($sub) > 0) {
            $dt = $dt->sub($this->buildInterval($sub));
        }

        return $dt;
    }

    public function subtractDelta(string|\DateTimeInterface $date, array $delta): \DateTimeImmutable
    {
        $dt = $this->toDateTimeImmutable($date);

        $add = [];
        $sub = [];
        foreach (['years', 'months', 'days', 'hours', 'minutes', 'seconds'] as $k) {
            $v = (int)($delta[$k] ?? 0);
            if ($v >= 0) $sub[$k] = $v;      // subtract positive => sub
            else $add[$k] = abs($v);         // subtract negative => add
        }

        if ($this->sumDelta($sub) > 0) {
            $dt = $dt->sub($this->buildInterval($sub));
        }
        if ($this->sumDelta($add) > 0) {
            $dt = $dt->add($this->buildInterval($add));
        }

        return $dt;
    }

    // ---------------------------
    // Timer + Alarm
    // ---------------------------

    /**
     * Creates a timer. Call ->start() to execute (blocking).
     * Alarm callback receives an array payload and must return either:
     * - array (will be rendered to JSON/HTML)
     * - string (treated as message)
     */
    public function setTimer(int $seconds, ?callable $onAlarm = null): CalendarTimer
    {
        return new CalendarTimer($seconds, $onAlarm, $this->tz);
    }

    // ---------------------------
    // Outputs: JSON / HTML
    // ---------------------------

    public function toJson(mixed $data, int $jsonFlags = 0): string
    {
        $flags = $jsonFlags ?: (JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
        return json_encode($data, $flags) ?: '{"ok":false,"error":"json_encode_failed"}';
    }

    /**
     * Simple HTML output helper.
     * - arrays/objects -> pretty <pre> JSON
     * - strings -> escaped <div>
     */
    public function toHtml(mixed $data): string
    {
        if (is_array($data) || is_object($data)) {
            $json = htmlspecialchars($this->toJson($data, JSON_PRETTY_PRINT), ENT_QUOTES, 'UTF-8');
            return "<pre class=\"calendar-output\">{$json}</pre>";
        }
        $msg = htmlspecialchars((string)$data, ENT_QUOTES, 'UTF-8');
        return "<div class=\"calendar-output\">{$msg}</div>";
    }

    // ---------------------------
    // Month calendar (HTML + JSON matrix)
    // ---------------------------

    /**
     * Returns a 6x7 matrix of days for a month view.
     * $weekStartsOn: 1=Mon ... 7=Sun (default Mon)
     */
    public function monthMatrix(int $year, int $month, int $weekStartsOn = 1): array
    {
        $first = new \DateTimeImmutable(sprintf('%04d-%02d-01 00:00:00', $year, $month), $this->tz);
        $today = new \DateTimeImmutable('now', $this->tz);

        // PHP: N = 1(Mon) ... 7(Sun)
        $firstDow = (int)$first->format('N');
        $offset = ($firstDow - $weekStartsOn + 7) % 7;
        $start = $first->modify("-{$offset} days");

        $cells = [];
        for ($i = 0; $i < 42; $i++) {
            $d = $start->modify("+{$i} days");
            $isoDate = $d->format('Y-m-d');
            $inMonth = ((int)$d->format('n') === $month);

            $cells[] = [
                'date' => $isoDate,
                'day' => (int)$d->format('j'),
                'month' => (int)$d->format('n'),
                'year' => (int)$d->format('Y'),
                'inMonth' => $inMonth,
                'isToday' => ($isoDate === $today->format('Y-m-d')),
                'events' => $this->events[$isoDate] ?? [],
            ];
        }

        // chunk into 6 weeks
        return array_chunk($cells, 7);
    }

    public function monthMatrixJson(int $year, int $month, int $weekStartsOn = 1): string
    {
        return $this->toJson([
            'ok' => true,
            'year' => $year,
            'month' => $month,
            'weekStartsOn' => $weekStartsOn,
            'weeks' => $this->monthMatrix($year, $month, $weekStartsOn),
        ]);
    }

    public function monthHtml(int $year, int $month, int $weekStartsOn = 1): string
    {
        $weeks = $this->monthMatrix($year, $month, $weekStartsOn);

        $labels = [1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun'];
        $header = [];
        for ($i = 0; $i < 7; $i++) {
            $dayIndex = (($weekStartsOn - 1 + $i) % 7) + 1;
            $header[] = $labels[$dayIndex];
        }

        $title = htmlspecialchars((new \DateTimeImmutable(sprintf('%04d-%02d-01', $year, $month), $this->tz))->format('F Y'), ENT_QUOTES, 'UTF-8');

        $html = [];
        $html[] = "<div class=\"calendar\">";
        $html[] = "  <div class=\"calendar-title\">{$title}</div>";
        $html[] = "  <table class=\"calendar-table\" cellpadding=\"0\" cellspacing=\"0\">";
        $html[] = "    <thead><tr>";
        foreach ($header as $h) {
            $html[] = "      <th>{$h}</th>";
        }
        $html[] = "    </tr></thead>";
        $html[] = "    <tbody>";

        foreach ($weeks as $week) {
            $html[] = "      <tr>";
            foreach ($week as $cell) {
                $classes = [];
                if (!$cell['inMonth']) $classes[] = 'is-outside';
                if ($cell['isToday']) $classes[] = 'is-today';
                if (!empty($cell['events'])) $classes[] = 'has-events';

                $classAttr = $classes ? ' class="' . htmlspecialchars(implode(' ', $classes), ENT_QUOTES, 'UTF-8') . '"' : '';
                $dayNum = (int)$cell['day'];

                // small event count badge
                $badge = '';
                if (!empty($cell['events'])) {
                    $badge = '<span class="event-badge">' . count($cell['events']) . '</span>';
                }

                $dateAttr = htmlspecialchars($cell['date'], ENT_QUOTES, 'UTF-8');
                $html[] = "        <td{$classAttr} data-date=\"{$dateAttr}\"><span class=\"day\">{$dayNum}</span>{$badge}</td>";
            }
            $html[] = "      </tr>";
        }

        $html[] = "    </tbody>";
        $html[] = "  </table>";
        $html[] = "</div>";

        return implode("\n", $html);
    }

    // ---------------------------
    // Optional events
    // ---------------------------

    public function addEvent(string|\DateTimeInterface $date, string $title, array $meta = []): array
    {
        $d = $this->toDateTimeImmutable($date)->format('Y-m-d');

        $event = [
            'id' => bin2hex(random_bytes(8)),
            'date' => $d,
            'title' => $title,
            'meta' => $meta,
        ];

        $this->events[$d] ??= [];
        $this->events[$d][] = $event;

        return $event;
    }

    public function eventsForDate(string|\DateTimeInterface $date): array
    {
        $d = $this->toDateTimeImmutable($date)->format('Y-m-d');
        return $this->events[$d] ?? [];
    }

    // ---------------------------
    // Internals
    // ---------------------------

    private function toDateTimeImmutable(string|\DateTimeInterface $input): \DateTimeImmutable
    {
        if ($input instanceof \DateTimeImmutable) {
            return $input->setTimezone($this->tz);
        }
        if ($input instanceof \DateTimeInterface) {
            return (new \DateTimeImmutable($input->format('c')))->setTimezone($this->tz);
        }
        // string input
        return new \DateTimeImmutable($input, $this->tz);
    }

    /** Build DateInterval from delta (non-negative fields only). */
    private function buildInterval(array $delta): \DateInterval
    {
        $y = max(0, (int)($delta['years'] ?? 0));
        $mo = max(0, (int)($delta['months'] ?? 0));
        $d = max(0, (int)($delta['days'] ?? 0));
        $h = max(0, (int)($delta['hours'] ?? 0));
        $mi = max(0, (int)($delta['minutes'] ?? 0));
        $s = max(0, (int)($delta['seconds'] ?? 0));

        // ISO 8601 duration: PnYnMnDTnHnMnS
        $spec = "P{$y}Y{$mo}M{$d}DT{$h}H{$mi}M{$s}S";
        return new \DateInterval($spec);
    }

    private function sumDelta(array $delta): int
    {
        $sum = 0;
        foreach (['years', 'months', 'days', 'hours', 'minutes', 'seconds'] as $k) {
            $sum += (int)($delta[$k] ?? 0);
        }
        return $sum;
    }
}

/**
 * Timer that triggers alarm when it expires.
 * Note: This is a blocking timer. For “web alarms” across requests, you’d typically use cron/queue,
 * but this works well for CLI scripts or long-running PHP processes.
 */
 class JX_CalendarTimer
{
    private int $seconds;
    private  $onAlarm;
    private \DateTimeZone $tz;

    private bool $cancelled = false;
    private bool $expired = false;

    private ?\DateTimeImmutable $startedAt = null;
    private ?\DateTimeImmutable $expiresAt = null;

    public function __construct(int $seconds, ?callable $onAlarm, \DateTimeZone $tz)
    {
        $this->seconds = max(0, $seconds);
        $this->onAlarm = $onAlarm;
        $this->tz = $tz;
    }

    public function cancel(): void
    {
        $this->cancelled = true;
    }

    public function meta(): array
    {
        return [
            'seconds' => $this->seconds,
            'cancelled' => $this->cancelled,
            'expired' => $this->expired,
            'startedAt' => $this->startedAt?->format('c'),
            'expiresAt' => $this->expiresAt?->format('c'),
        ];
    }

    /**
     * Executes the timer (blocking).
     * $format: 'json' | 'html'
     */
    public function start(string $format = 'json'): string
    {
        $this->startedAt = new \DateTimeImmutable('now', $this->tz);
        $this->expiresAt = $this->startedAt->add(new \DateInterval('PT' . $this->seconds . 'S'));

        $end = microtime(true) + $this->seconds;

        while (!$this->cancelled && microtime(true) < $end) {
            // sleep 50ms to avoid burning CPU
            usleep(50_000);
        }

        $this->expired = !$this->cancelled;

        $payload = [
            'ok' => true,
            'type' => $this->cancelled ? 'timer_cancelled' : 'timer_expired',
            'meta' => $this->meta(),
            'alarm' => false,
            'data' => null,
        ];

        if ($this->expired) {
            $payload['alarm'] = true;

            // default “alarm action” if callback is not provided:
            if ($this->onAlarm === null) {
                $payload['data'] = ['message' => 'ALARM: timer expired'];
            } else {
                $result = ($this->onAlarm)($payload);

                if (is_array($result) || is_object($result)) {
                    $payload['data'] = $result;
                } else {
                    $payload['data'] = ['message' => (string)$result];
                }
            }
        }

        return $this->render($payload, $format);
    }

    private function render(array $payload, string $format): string
    {
        $format = strtolower(trim($format));

        if ($format === 'html') {
            $safeType = htmlspecialchars((string)$payload['type'], ENT_QUOTES, 'UTF-8');
            $safeMsg = htmlspecialchars(json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '', ENT_QUOTES, 'UTF-8');

            $alarmClass = $payload['alarm'] ? ' timer-alarm' : '';
            return "<div class=\"timer{$alarmClass}\"><strong>{$safeType}</strong><pre>{$safeMsg}</pre></div>";
        }

        // default json
        return json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR)
            ?: '{"ok":false,"error":"json_encode_failed"}';
    }
}
