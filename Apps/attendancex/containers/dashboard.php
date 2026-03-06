<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>JamilSoft AMS — Teacher Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Nunito+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --navy: #060C1A;
      --navy-mid: #0D1730;
      --navy-card: #0F1A2E;
      --navy-card2: #111E35;
      --navy-border: #1C2E4A;
      --teal: #00D4AA;
      --teal-dim: #00A882;
      --teal-glow: rgba(0,212,170,0.12);
      --amber: #F59E0B;
      --amber-glow: rgba(245,158,11,0.12);
      --red: #F87171;
      --red-glow: rgba(248,113,113,0.1);
      --blue: #60A5FA;
      --blue-glow: rgba(96,165,250,0.1);
      --purple: #A78BFA;
      --purple-glow: rgba(167,139,250,0.1);
      --green: #4ADE80;
      --green-glow: rgba(74,222,128,0.1);
      --text: #E2EAF4;
      --muted: #6B8099;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Nunito Sans', sans-serif;
      background: var(--navy);
      color: var(--text);
      min-height: 100vh;
      display: flex; flex-direction: column;
    }
    h1,h2,h3,h4,.mono { font-family: 'Rajdhani', sans-serif; }

    /* Scrollbar */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: var(--navy-mid); }
    ::-webkit-scrollbar-thumb { background: var(--navy-border); border-radius: 3px; }

    /* Grid bg */
    .grid-bg {
      position: fixed; inset: 0; z-index: 0; pointer-events: none;
      background-image:
        linear-gradient(rgba(0,212,170,0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,212,170,0.025) 1px, transparent 1px);
      background-size: 52px 52px;
    }

    /* ===== SIDEBAR ===== */
    .sidebar {
      position: fixed; top: 0; left: 0; bottom: 0;
      width: 220px;
      background: var(--navy-card);
      border-right: 1px solid var(--navy-border);
      display: flex; flex-direction: column;
      z-index: 100;
    }
    .sidebar-logo {
      padding: 22px 20px 18px;
      border-bottom: 1px solid var(--navy-border);
      flex-shrink: 0;
    }
    .logo-text { font-family: 'Rajdhani', sans-serif; font-size: 1.4rem; font-weight: 700; letter-spacing: 2px; }
    .logo-text span { color: var(--teal); }
    .logo-sub { font-size: 0.65rem; color: var(--muted); letter-spacing: 1px; text-transform: uppercase; margin-top: 2px; }

    .sidebar-nav { flex: 1; padding: 16px 0; overflow-y: auto; }
    .nav-section-label {
      font-family: 'Rajdhani', sans-serif;
      font-size: 0.62rem; font-weight: 700; letter-spacing: 2px;
      color: var(--muted); text-transform: uppercase;
      padding: 10px 20px 6px;
    }
    .nav-item {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 20px;
      font-family: 'Rajdhani', sans-serif; font-size: 0.9rem; font-weight: 600;
      letter-spacing: 0.5px; color: var(--muted);
      cursor: pointer; transition: all 0.15s;
      border-left: 3px solid transparent;
      text-decoration: none;
    }
    .nav-item:hover { background: rgba(255,255,255,0.03); color: var(--text); }
    .nav-item.active { color: var(--teal); background: rgba(0,212,170,0.06); border-left-color: var(--teal); }
    .nav-item .nav-icon { font-size: 1rem; width: 20px; text-align: center; }
    .nav-badge {
      margin-left: auto;
      background: var(--teal); color: var(--navy);
      font-family: 'Rajdhani', sans-serif; font-size: 0.65rem; font-weight: 700;
      padding: 1px 7px; border-radius: 10px; min-width: 20px; text-align: center;
    }

    .sidebar-bottom {
      padding: 16px;
      border-top: 1px solid var(--navy-border);
      flex-shrink: 0;
    }
    .teacher-card {
      display: flex; align-items: center; gap: 10px;
      padding: 10px;
      background: var(--navy);
      border: 1px solid var(--navy-border);
      border-radius: 8px;
      cursor: pointer; transition: border-color 0.2s;
    }
    .teacher-card:hover { border-color: rgba(0,212,170,0.3); }
    .teacher-avatar {
      width: 34px; height: 34px; border-radius: 50%;
      background: var(--teal-glow); border: 1.5px solid rgba(0,212,170,0.4);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Rajdhani', sans-serif; font-size: 0.85rem; font-weight: 700; color: var(--teal);
      flex-shrink: 0;
    }
    .teacher-name { font-family: 'Rajdhani', sans-serif; font-size: 0.85rem; font-weight: 700; }
    .teacher-role { font-size: 0.7rem; color: var(--muted); }

    /* ===== TOPBAR ===== */
    .topbar {
      position: fixed; top: 0; left: 220px; right: 0;
      height: 60px;
      background: rgba(6,12,26,0.92);
      border-bottom: 1px solid var(--navy-border);
      backdrop-filter: blur(12px);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 28px;
      z-index: 90;
    }
    .topbar-left { display: flex; align-items: center; gap: 16px; }
    .page-title { font-size: 1.1rem; font-weight: 700; }
    .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 0.78rem; color: var(--muted); }
    .breadcrumb span.sep { opacity: 0.4; }
    .breadcrumb span.cur { color: var(--teal); }
    .topbar-right { display: flex; align-items: center; gap: 14px; }

    /* Live indicator */
    .live-indicator {
      display: flex; align-items: center; gap: 6px;
      background: rgba(74,222,128,0.08);
      border: 1px solid rgba(74,222,128,0.25);
      border-radius: 20px; padding: 4px 12px;
      font-family: 'Rajdhani', sans-serif; font-size: 0.72rem; font-weight: 700;
      letter-spacing: 1.5px; color: var(--green); text-transform: uppercase;
    }
    .live-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--green); animation: blink 1.2s ease infinite; }

    /* Date display */
    .date-display { font-family: 'Rajdhani', sans-serif; font-size: 0.8rem; font-weight: 600; color: var(--muted); }

    /* Notif btn */
    .notif-btn {
      position: relative; width: 36px; height: 36px;
      background: var(--navy-card2); border: 1px solid var(--navy-border);
      border-radius: 8px; display: flex; align-items: center; justify-content: center;
      cursor: pointer; font-size: 0.95rem; transition: border-color 0.2s;
    }
    .notif-btn:hover { border-color: rgba(0,212,170,0.3); }
    .notif-badge {
      position: absolute; top: -4px; right: -4px;
      width: 16px; height: 16px; background: var(--red);
      border-radius: 50%; font-family: 'Rajdhani',sans-serif;
      font-size: 0.6rem; font-weight: 700; color: #fff;
      display: flex; align-items: center; justify-content: center;
      border: 2px solid var(--navy);
    }

    /* ===== MAIN CONTENT ===== */
    .main-content {
      position: relative; z-index: 1;
      margin-left: 220px;
      padding-top: 60px;
      min-height: 100vh;
    }
    .content-inner { padding: 28px; }

    /* Class context bar */
    .context-bar {
      display: flex; align-items: center; flex-wrap: wrap; gap: 10px;
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: 10px; padding: 12px 18px;
      margin-bottom: 24px;
    }
    .ctx-item {
      display: flex; align-items: center; gap: 8px;
      padding: 4px 12px;
      border-radius: 6px;
    }
    .ctx-label { font-family: 'Rajdhani', sans-serif; font-size: 0.65rem; font-weight: 700; letter-spacing: 1.5px; color: var(--muted); text-transform: uppercase; }
    .ctx-value { font-family: 'Rajdhani', sans-serif; font-size: 0.9rem; font-weight: 700; margin-left: 2px; }
    .ctx-div { width: 1px; height: 28px; background: var(--navy-border); }

    .ctx-semester .ctx-value { color: var(--amber); }
    .ctx-level .ctx-value { color: var(--blue); }
    .ctx-course .ctx-value { color: var(--purple); }
    .ctx-time .ctx-value { color: var(--teal); }

    /* ===== STAT CARDS ===== */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      margin-bottom: 24px;
    }
    @media (max-width: 1100px) { .stats-grid { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 640px) { .stats-grid { grid-template-columns: 1fr; } }

    .stat-card {
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: 10px; padding: 20px;
      position: relative; overflow: hidden;
      transition: border-color 0.2s, transform 0.2s;
      animation: slideIn 0.5s ease both;
    }
    .stat-card:hover { transform: translateY(-2px); }
    .stat-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
      border-radius: 2px 2px 0 0;
    }
    .stat-card.teal::before { background: linear-gradient(90deg, var(--teal), transparent); }
    .stat-card.teal { border-color: rgba(0,212,170,0.2); }
    .stat-card.amber::before { background: linear-gradient(90deg, var(--amber), transparent); }
    .stat-card.amber { border-color: rgba(245,158,11,0.2); }
    .stat-card.blue::before { background: linear-gradient(90deg, var(--blue), transparent); }
    .stat-card.blue { border-color: rgba(96,165,250,0.2); }
    .stat-card.purple::before { background: linear-gradient(90deg, var(--purple), transparent); }
    .stat-card.purple { border-color: rgba(167,139,250,0.2); }

    .stat-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 14px; }
    .stat-icon {
      width: 40px; height: 40px; border-radius: 8px;
      display: flex; align-items: center; justify-content: center; font-size: 1.1rem;
    }
    .stat-icon.teal { background: var(--teal-glow); }
    .stat-icon.amber { background: var(--amber-glow); }
    .stat-icon.blue { background: var(--blue-glow); }
    .stat-icon.purple { background: var(--purple-glow); }
    .stat-trend {
      font-family: 'Rajdhani', sans-serif; font-size: 0.72rem; font-weight: 700;
      padding: 2px 8px; border-radius: 4px;
    }
    .stat-trend.up { color: var(--green); background: var(--green-glow); }
    .stat-trend.down { color: var(--red); background: var(--red-glow); }
    .stat-trend.neutral { color: var(--muted); background: rgba(107,128,153,0.1); }

    .stat-value {
      font-family: 'Rajdhani', sans-serif; font-size: 2.4rem; font-weight: 700;
      line-height: 1; margin-bottom: 4px;
      transition: opacity 0.4s;
    }
    .stat-label { font-size: 0.8rem; color: var(--muted); }
    .stat-sublabel { font-family: 'Rajdhani', sans-serif; font-size: 0.7rem; color: var(--muted); margin-top: 8px; }

    /* Mini sparkline */
    .sparkline-wrap { margin-top: 12px; height: 36px; }
    .sparkline { width: 100%; height: 36px; }

    /* ===== BOTTOM GRID ===== */
    .bottom-grid {
      display: grid;
      grid-template-columns: 1fr 360px;
      gap: 16px;
    }
    @media (max-width: 1000px) { .bottom-grid { grid-template-columns: 1fr; } }

    /* Attendance table */
    .panel {
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: 10px; overflow: hidden;
    }
    .panel-head {
      padding: 16px 20px;
      border-bottom: 1px solid var(--navy-border);
      display: flex; align-items: center; justify-content: space-between;
    }
    .panel-title-text { font-size: 1rem; font-weight: 700; }
    .panel-meta { font-size: 0.75rem; color: var(--muted); }
    .panel-actions { display: flex; gap: 8px; }
    .panel-btn {
      font-family: 'Rajdhani', sans-serif; font-size: 0.72rem; font-weight: 700; letter-spacing: 1px;
      padding: 5px 12px; border-radius: 5px; cursor: pointer; text-transform: uppercase;
      border: 1px solid var(--navy-border); background: transparent; color: var(--muted);
      transition: all 0.15s;
    }
    .panel-btn:hover { border-color: rgba(0,212,170,0.3); color: var(--teal); }
    .panel-btn.primary { border-color: rgba(0,212,170,0.4); color: var(--teal); background: var(--teal-glow); }

    /* Search bar */
    .search-wrap {
      padding: 12px 20px;
      border-bottom: 1px solid var(--navy-border);
      display: flex; align-items: center; gap: 10px;
    }
    .search-input {
      flex: 1; background: var(--navy); border: 1px solid var(--navy-border);
      border-radius: 6px; padding: 7px 12px 7px 34px;
      font-family: 'Nunito Sans', sans-serif; font-size: 0.84rem;
      color: var(--text); outline: none;
      transition: border-color 0.2s;
      position: relative;
    }
    .search-input:focus { border-color: rgba(0,212,170,0.4); }
    .search-input::placeholder { color: var(--muted); opacity: 0.5; }
    .search-wrap-inner { position: relative; flex: 1; }
    .search-icon { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 0.85rem; pointer-events: none; }

    /* Filter tabs */
    .filter-tabs { display: flex; gap: 6px; }
    .filter-tab {
      font-family: 'Rajdhani', sans-serif; font-size: 0.72rem; font-weight: 700; letter-spacing: 1px;
      padding: 5px 12px; border-radius: 5px; cursor: pointer; text-transform: uppercase;
      border: 1px solid var(--navy-border); background: transparent; color: var(--muted);
      transition: all 0.15s;
    }
    .filter-tab.active { border-color: rgba(0,212,170,0.4); color: var(--teal); background: var(--teal-glow); }

    /* Table */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead tr { border-bottom: 1px solid var(--navy-border); }
    thead th {
      padding: 10px 16px;
      font-family: 'Rajdhani', sans-serif; font-size: 0.7rem; font-weight: 700;
      letter-spacing: 1.5px; color: var(--muted); text-transform: uppercase;
      text-align: left; white-space: nowrap;
    }
    tbody tr {
      border-bottom: 1px solid rgba(28,46,74,0.5);
      transition: background 0.15s;
    }
    tbody tr:hover { background: rgba(255,255,255,0.02); }
    tbody tr:last-child { border-bottom: none; }
    td { padding: 12px 16px; font-size: 0.85rem; white-space: nowrap; }

    .student-cell { display: flex; align-items: center; gap: 10px; }
    .student-avatar {
      width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Rajdhani', sans-serif; font-size: 0.72rem; font-weight: 700;
    }
    .student-name { font-weight: 600; font-size: 0.87rem; }
    .student-id { font-family: 'Rajdhani', sans-serif; font-size: 0.72rem; color: var(--muted); }

    .status-badge {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 3px 10px; border-radius: 20px;
      font-family: 'Rajdhani', sans-serif; font-size: 0.72rem; font-weight: 700;
      letter-spacing: 0.5px; text-transform: uppercase;
    }
    .status-badge.present { background: rgba(74,222,128,0.1); color: var(--green); border: 1px solid rgba(74,222,128,0.25); }
    .status-badge.absent { background: var(--red-glow); color: var(--red); border: 1px solid rgba(248,113,113,0.25); }
    .status-badge.late { background: var(--amber-glow); color: var(--amber); border: 1px solid rgba(245,158,11,0.25); }
    .status-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

    .attend-pct {
      font-family: 'Rajdhani', sans-serif; font-size: 0.9rem; font-weight: 700;
    }
    .attend-pct.high { color: var(--green); }
    .attend-pct.mid { color: var(--amber); }
    .attend-pct.low { color: var(--red); }

    .pct-bar-wrap { width: 60px; height: 4px; background: rgba(255,255,255,0.06); border-radius: 2px; margin-top: 3px; }
    .pct-bar { height: 100%; border-radius: 2px; }
    .pct-bar.high { background: var(--green); }
    .pct-bar.mid { background: var(--amber); }
    .pct-bar.low { background: var(--red); }

    .time-cell { font-family: 'Rajdhani', sans-serif; font-size: 0.85rem; font-weight: 600; color: var(--muted); }

    /* Pagination */
    .table-footer {
      padding: 12px 20px;
      border-top: 1px solid var(--navy-border);
      display: flex; align-items: center; justify-content: space-between;
      font-size: 0.78rem; color: var(--muted);
    }
    .pagination { display: flex; gap: 4px; }
    .page-btn {
      width: 28px; height: 28px; border-radius: 5px;
      background: transparent; border: 1px solid var(--navy-border);
      color: var(--muted); font-family: 'Rajdhani', sans-serif;
      font-size: 0.82rem; font-weight: 700;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; transition: all 0.15s;
    }
    .page-btn.active { background: var(--teal-glow); border-color: rgba(0,212,170,0.4); color: var(--teal); }
    .page-btn:hover:not(.active) { border-color: var(--muted); color: var(--text); }

    /* ===== RIGHT PANEL: Activity + Donut ===== */
    .right-col { display: flex; flex-direction: column; gap: 16px; }

    /* Donut chart */
    .donut-wrap { padding: 20px; display: flex; flex-direction: column; align-items: center; }
    .donut-title { font-size: 0.9rem; font-weight: 700; margin-bottom: 16px; align-self: flex-start; }
    .donut-container { position: relative; width: 140px; height: 140px; margin-bottom: 20px; }
    .donut-svg { width: 140px; height: 140px; transform: rotate(-90deg); }
    .donut-center {
      position: absolute; inset: 0;
      display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    .donut-pct { font-family: 'Rajdhani', sans-serif; font-size: 2rem; font-weight: 700; line-height: 1; }
    .donut-sub { font-size: 0.65rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; }
    .donut-legend { width: 100%; display: flex; flex-direction: column; gap: 8px; }
    .legend-row { display: flex; align-items: center; justify-content: space-between; }
    .legend-left { display: flex; align-items: center; gap: 8px; font-size: 0.82rem; }
    .legend-dot { width: 8px; height: 8px; border-radius: 2px; flex-shrink: 0; }
    .legend-right { font-family: 'Rajdhani', sans-serif; font-size: 0.88rem; font-weight: 700; }

    /* Activity feed */
    .activity-feed { padding: 0; }
    .activity-item {
      display: flex; align-items: flex-start; gap: 12px;
      padding: 12px 20px;
      border-bottom: 1px solid rgba(28,46,74,0.5);
      transition: background 0.15s;
    }
    .activity-item:hover { background: rgba(255,255,255,0.015); }
    .activity-item:last-child { border-bottom: none; }
    .activity-icon {
      width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center; font-size: 0.85rem;
    }
    .activity-icon.green { background: var(--green-glow); }
    .activity-icon.red { background: var(--red-glow); }
    .activity-icon.amber { background: var(--amber-glow); }
    .activity-name { font-weight: 600; font-size: 0.84rem; }
    .activity-action { font-size: 0.75rem; color: var(--muted); margin-top: 1px; }
    .activity-time { margin-left: auto; font-family: 'Rajdhani', sans-serif; font-size: 0.72rem; color: var(--muted); white-space: nowrap; margin-top: 2px; }

    /* ===== WEEK CHART ===== */
    .week-chart-wrap { padding: 20px; }
    .week-title { font-size: 0.9rem; font-weight: 700; margin-bottom: 16px; }
    .week-bars { display: flex; align-items: flex-end; gap: 8px; height: 80px; }
    .week-bar-col { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 4px; }
    .week-bar-track { flex: 1; width: 100%; background: rgba(255,255,255,0.04); border-radius: 4px; overflow: hidden; position: relative; display: flex; flex-direction: column; justify-content: flex-end; }
    .week-bar-fill { width: 100%; border-radius: 4px; transition: height 1s cubic-bezier(0.22,1,0.36,1); }
    .week-bar-fill.teal { background: linear-gradient(180deg, rgba(0,212,170,0.9), rgba(0,212,170,0.5)); }
    .week-bar-fill.today { background: linear-gradient(180deg, var(--teal), var(--teal-dim)); box-shadow: 0 0 10px rgba(0,212,170,0.4); }
    .week-day { font-family: 'Rajdhani', sans-serif; font-size: 0.65rem; font-weight: 700; letter-spacing: 1px; color: var(--muted); text-transform: uppercase; }
    .week-day.today { color: var(--teal); }

    /* Quick Actions */
    .quick-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; padding: 16px; }
    .qa-btn {
      display: flex; flex-direction: column; align-items: center; gap: 6px;
      padding: 14px 10px;
      background: var(--navy);
      border: 1px solid var(--navy-border);
      border-radius: 8px; cursor: pointer; transition: all 0.15s;
      text-align: center;
    }
    .qa-btn:hover { border-color: rgba(0,212,170,0.3); background: rgba(0,212,170,0.03); }
    .qa-icon { font-size: 1.2rem; }
    .qa-label { font-family: 'Rajdhani', sans-serif; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.5px; color: var(--muted); }

    /* Animations */
    @keyframes slideIn { from { opacity:0; transform: translateY(16px); } to { opacity:1; transform: none; } }
    @keyframes blink { 0%,100% { opacity:1; } 50% { opacity:0.3; } }
    @keyframes countUp { from { opacity:0; transform: translateY(8px); } to { opacity:1; transform: none; } }

    /* Responsive sidebar collapse for small screens */
    @media (max-width: 768px) {
      .sidebar { display: none; }
      .topbar { left: 0; }
      .main-content { margin-left: 0; }
    }
  </style>
</head>
<body>

  <div class="grid-bg"></div>

  <!-- ===== SIDEBAR ===== -->
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-text">JAMIL<span>AMS</span></div>
      <div class="logo-sub">Attendance System</div>
    </div>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Main</div>
      <a href="dashboard.html" class="nav-item active">
        <span class="nav-icon">📊</span> Dashboard
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon">📋</span> Attendance
        <span class="nav-badge">5</span>
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon">👥</span> Students
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon">📅</span> Schedule
      </a>

      <div class="nav-section-label" style="margin-top:8px;">Reports</div>
      <a href="#" class="nav-item">
        <span class="nav-icon">📈</span> Analytics
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon">📄</span> Export
      </a>

      <div class="nav-section-label" style="margin-top:8px;">System</div>
      <a href="signup.html" class="nav-item">
        <span class="nav-icon">➕</span> Enroll Student
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon">⚙️</span> Settings
      </a>
    </nav>

    <div class="sidebar-bottom">
      <div class="teacher-card">
        <div class="teacher-avatar">JM</div>
        <div>
          <div class="teacher-name">Mr. J. Musa</div>
          <div class="teacher-role">Class Coordinator</div>
        </div>
      </div>
    </div>
  </aside>

  <!-- ===== TOPBAR ===== -->
  <header class="topbar">
    <div class="topbar-left">
      <div>
        <h1 class="page-title">Teacher Dashboard</h1>
        <div class="breadcrumb">
          <span>AMS</span><span class="sep">/</span><span class="cur">Overview</span>
        </div>
      </div>
    </div>
    <div class="topbar-right">
      <div class="live-indicator"><div class="live-dot"></div> LIVE</div>
      <div class="date-display" id="dateDisplay">—</div>
      <div class="notif-btn" title="Notifications">🔔<div class="notif-badge">3</div></div>
      <a href="login.html" style="text-decoration:none;">
        <div class="notif-btn" title="Logout" style="font-size:0.8rem; color:var(--muted);">⏻</div>
      </a>
    </div>
  </header>

  <!-- ===== MAIN CONTENT ===== -->
  <main class="main-content">
    <div class="content-inner">

      <!-- Context Bar -->
      <div class="context-bar">
        <div class="ctx-item ctx-semester">
          <span class="ctx-label">Semester</span>
          <span class="ctx-value">2nd Semester</span>
        </div>
        <div class="ctx-div"></div>
        <div class="ctx-item ctx-level">
          <span class="ctx-label">Class Level</span>
          <span class="ctx-value" id="ctxLevel">ND I</span>
        </div>
        <div class="ctx-div"></div>
        <div class="ctx-item ctx-course">
          <span class="ctx-label">Course</span>
          <span class="ctx-value">COM 201 — Computer Fundamentals</span>
        </div>
        <div class="ctx-div"></div>
        <div class="ctx-item ctx-time">
          <span class="ctx-label">Session</span>
          <span class="ctx-value">2024/2025</span>
        </div>
        <div style="margin-left:auto; display:flex; gap:8px;">
          <button class="panel-btn" onclick="toggleLevel()">Switch Level ⇄</button>
          <button class="panel-btn primary" onclick="markAttendance()">+ Mark Now</button>
        </div>
      </div>

      <!-- Stat Cards -->
      <div class="stats-grid">
        <div class="stat-card teal" style="animation-delay:0.05s">
          <div class="stat-header">
            <div class="stat-icon teal">✅</div>
            <span class="stat-trend up">↑ 4.2%</span>
          </div>
          <div class="stat-value teal-val" id="statPresent">—</div>
          <div class="stat-label">Present Today</div>
          <div class="stat-sublabel" id="statPresentSub">Out of 42 total students</div>
          <div class="sparkline-wrap"><canvas class="sparkline" id="spark1"></canvas></div>
        </div>

        <div class="stat-card amber" style="animation-delay:0.1s">
          <div class="stat-header">
            <div class="stat-icon amber">👥</div>
            <span class="stat-trend neutral">ND I + ND II</span>
          </div>
          <div class="stat-value" id="statTotal">—</div>
          <div class="stat-label">Total Students</div>
          <div class="stat-sublabel" id="statTotalSub">Enrolled this semester</div>
          <div class="sparkline-wrap"><canvas class="sparkline" id="spark2"></canvas></div>
        </div>

        <div class="stat-card blue" style="animation-delay:0.15s">
          <div class="stat-header">
            <div class="stat-icon blue">📚</div>
            <span class="stat-trend up">Active</span>
          </div>
          <div class="stat-value" style="color:var(--blue)" id="statSemester">2nd</div>
          <div class="stat-label">Current Semester</div>
          <div class="stat-sublabel">Ends: July 2025</div>
          <div class="sparkline-wrap"><canvas class="sparkline" id="spark3"></canvas></div>
        </div>

        <div class="stat-card purple" style="animation-delay:0.2s">
          <div class="stat-header">
            <div class="stat-icon purple">🎓</div>
            <span class="stat-trend neutral" id="levelBadge">ND I</span>
          </div>
          <div class="stat-value" style="color:var(--purple)" id="statAbsent">—</div>
          <div class="stat-label">Absent Today</div>
          <div class="stat-sublabel" id="statAbsentSub">Need follow-up</div>
          <div class="sparkline-wrap"><canvas class="sparkline" id="spark4"></canvas></div>
        </div>
      </div>

      <!-- Week Chart -->
      <div class="panel" style="margin-bottom:16px;">
        <div class="panel-head">
          <div>
            <div class="panel-title-text">Weekly Attendance Overview</div>
            <div class="panel-meta">This week — <span style="color:var(--teal);">COM 201</span></div>
          </div>
          <div class="panel-actions">
            <button class="panel-btn">This Week</button>
            <button class="panel-btn">Export</button>
          </div>
        </div>
        <div class="week-chart-wrap">
          <div class="week-bars" id="weekBars"></div>
        </div>
      </div>

      <!-- Bottom Grid -->
      <div class="bottom-grid">

        <!-- Attendance Table -->
        <div class="panel">
          <div class="panel-head">
            <div>
              <div class="panel-title-text">Today's Attendance Register</div>
              <div class="panel-meta" id="todayDateMeta">Loading...</div>
            </div>
            <div class="panel-actions">
              <button class="panel-btn">📤 Export</button>
              <button class="panel-btn primary" onclick="markAttendance()">+ Mark</button>
            </div>
          </div>
          <!-- Filter + Search -->
          <div class="search-wrap">
            <div class="search-wrap-inner">
              <span class="search-icon">🔍</span>
              <input type="text" class="search-input" id="searchInput" placeholder="Search student name or matric..." oninput="filterTable()"/>
            </div>
            <div class="filter-tabs">
              <button class="filter-tab active" onclick="filterStatus('all', this)">All</button>
              <button class="filter-tab" onclick="filterStatus('present', this)">Present</button>
              <button class="filter-tab" onclick="filterStatus('absent', this)">Absent</button>
              <button class="filter-tab" onclick="filterStatus('late', this)">Late</button>
            </div>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Student</th>
                  <th>Level</th>
                  <th>Status</th>
                  <th>Time In</th>
                  <th>Attendance %</th>
                </tr>
              </thead>
              <tbody id="attendanceTable"></tbody>
            </table>
          </div>
          <div class="table-footer">
            <span id="tableCount">Loading...</span>
            <div class="pagination" id="pagination"></div>
          </div>
        </div>

        <!-- Right Column -->
        <div class="right-col">

          <!-- Donut Chart -->
          <div class="panel">
            <div class="panel-head">
              <div class="panel-title-text">Today's Breakdown</div>
            </div>
            <div class="donut-wrap">
              <div class="donut-container">
                <svg class="donut-svg" viewBox="0 0 120 120" id="donutSvg">
                  <!-- Segments drawn by JS -->
                </svg>
                <div class="donut-center">
                  <div class="donut-pct" id="donutPct" style="color:var(--teal)">—</div>
                  <div class="donut-sub">Present</div>
                </div>
              </div>
              <div class="donut-legend">
                <div class="legend-row">
                  <div class="legend-left"><div class="legend-dot" style="background:var(--green)"></div> Present</div>
                  <div class="legend-right" id="legendPresent" style="color:var(--green)">—</div>
                </div>
                <div class="legend-row">
                  <div class="legend-left"><div class="legend-dot" style="background:var(--red)"></div> Absent</div>
                  <div class="legend-right" id="legendAbsent" style="color:var(--red)">—</div>
                </div>
                <div class="legend-row">
                  <div class="legend-left"><div class="legend-dot" style="background:var(--amber)"></div> Late</div>
                  <div class="legend-right" id="legendLate" style="color:var(--amber)">—</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="panel">
            <div class="panel-head"><div class="panel-title-text">Quick Actions</div></div>
            <div class="quick-actions">
              <div class="qa-btn" onclick="markAttendance()">
                <div class="qa-icon">✅</div>
                <div class="qa-label">Mark Attendance</div>
              </div>
              <div class="qa-btn">
                <div class="qa-icon">📊</div>
                <div class="qa-label">View Report</div>
              </div>
              <a href="signup.html" style="text-decoration:none;">
                <div class="qa-btn">
                  <div class="qa-icon">➕</div>
                  <div class="qa-label">Add Student</div>
                </div>
              </a>
              <div class="qa-btn">
                <div class="qa-icon">📤</div>
                <div class="qa-label">Export CSV</div>
              </div>
            </div>
          </div>

          <!-- Live Activity -->
          <div class="panel">
            <div class="panel-head">
              <div class="panel-title-text">Live Activity</div>
              <div class="live-indicator" style="font-size:0.65rem; padding:3px 8px;"><div class="live-dot"></div> LIVE</div>
            </div>
            <div class="activity-feed" id="activityFeed"></div>
          </div>

        </div>
      </div>

    </div>
  </main>

  <!-- Toast -->
  <div id="toast" style="
    position:fixed; bottom:24px; right:24px; z-index:200;
    background:var(--navy-card); border:1px solid rgba(0,212,170,0.3);
    border-radius:10px; padding:14px 18px;
    font-family:'Rajdhani',sans-serif; font-size:0.85rem; font-weight:600;
    color:var(--teal); letter-spacing:0.5px;
    transform: translateY(100px); opacity:0;
    transition: all 0.3s ease;
    max-width: 320px;
    pointer-events: none;
  "></div>

  <script>
    // ===== DATA =====
    const students = [
      { id:'CS/ND1/2024/001', name:'Amina Bello',       level:'ND I',  status:'present', time:'08:12', pct:94, avatar:'AB', color:'#00D4AA' },
      { id:'CS/ND1/2024/002', name:'Kamalu Musa',        level:'ND I',  status:'present', time:'08:07', pct:88, avatar:'KM', color:'#60A5FA' },
      { id:'CS/ND1/2024/003', name:'Fatima Ibrahim',     level:'ND I',  status:'absent',  time:'—',     pct:62, avatar:'FI', color:'#F87171' },
      { id:'CS/ND1/2024/004', name:'Yusuf Abdullahi',    level:'ND I',  status:'late',    time:'09:44', pct:77, avatar:'YA', color:'#F59E0B' },
      { id:'CS/ND1/2024/005', name:'Aisha Sule',         level:'ND I',  status:'present', time:'07:58', pct:97, avatar:'AS', color:'#A78BFA' },
      { id:'CS/ND1/2024/006', name:'Ibrahim Garba',      level:'ND I',  status:'present', time:'08:22', pct:91, avatar:'IG', color:'#4ADE80' },
      { id:'CS/ND1/2024/007', name:'Halima Umar',        level:'ND I',  status:'absent',  time:'—',     pct:55, avatar:'HU', color:'#F87171' },
      { id:'CS/ND2/2024/001', name:'Danladi Shehu',      level:'ND II', status:'present', time:'08:05', pct:89, avatar:'DS', color:'#00D4AA' },
      { id:'CS/ND2/2024/002', name:'Rakiya Hassan',      level:'ND II', status:'present', time:'08:18', pct:93, avatar:'RH', color:'#60A5FA' },
      { id:'CS/ND2/2024/003', name:'Musa Adamu',         level:'ND II', status:'late',    time:'09:12', pct:74, avatar:'MA', color:'#F59E0B' },
      { id:'CS/ND2/2024/004', name:'Zainab Usman',       level:'ND II', status:'present', time:'08:01', pct:98, avatar:'ZU', color:'#A78BFA' },
      { id:'CS/ND2/2024/005', name:'Chukwuemeka Obi',   level:'ND II', status:'absent',  time:'—',     pct:44, avatar:'CO', color:'#F87171' },
    ];

    let currentFilter = 'all';
    let currentLevel = 'ND I';
    let filteredStudents = [...students];

    // ===== INIT =====
    function init() {
      updateDate();
      setInterval(updateDate, 60000);
      computeStats();
      renderTable();
      drawDonut();
      renderWeekChart();
      renderActivity();
      drawSparklines();
    }

    function updateDate() {
      const now = new Date();
      const opts = { weekday:'long', year:'numeric', month:'long', day:'numeric' };
      document.getElementById('dateDisplay').textContent = now.toLocaleDateString('en-NG', opts);
      document.getElementById('todayDateMeta').textContent = now.toLocaleDateString('en-NG', { weekday:'long', month:'long', day:'numeric', year:'numeric' });
    }

    function computeStats() {
      const total = students.length;
      const present = students.filter(s => s.status === 'present').length;
      const absent = students.filter(s => s.status === 'absent').length;
      const late = students.filter(s => s.status === 'late').length;
      animateCount('statPresent', present);
      animateCount('statTotal', total);
      animateCount('statAbsent', absent + late);
      document.getElementById('statPresent').style.color = 'var(--teal)';
      document.getElementById('statTotal').style.color = 'var(--amber)';
      document.getElementById('statPresentSub').textContent = `Out of ${total} total students`;
      document.getElementById('statTotalSub').textContent = `ND I: ${students.filter(s=>s.level==='ND I').length} | ND II: ${students.filter(s=>s.level==='ND II').length}`;
      document.getElementById('statAbsentSub').textContent = `${absent} absent + ${late} late`;
      document.getElementById('legendPresent').textContent = `${present} students`;
      document.getElementById('legendAbsent').textContent = `${absent} students`;
      document.getElementById('legendLate').textContent = `${late} students`;
      document.getElementById('donutPct').textContent = Math.round(present/total*100) + '%';
    }

    function animateCount(id, target) {
      const el = document.getElementById(id);
      let cur = 0;
      const step = Math.ceil(target / 20);
      const timer = setInterval(() => {
        cur = Math.min(cur + step, target);
        el.textContent = cur;
        if (cur >= target) clearInterval(timer);
      }, 40);
    }

    // ===== TABLE =====
    function renderTable() {
      const search = (document.getElementById('searchInput')?.value || '').toLowerCase();
      let data = students.filter(s => {
        const matchStatus = currentFilter === 'all' || s.status === currentFilter;
        const matchSearch = s.name.toLowerCase().includes(search) || s.id.toLowerCase().includes(search);
        return matchStatus && matchSearch;
      });
      filteredStudents = data;

      const tbody = document.getElementById('attendanceTable');
      tbody.innerHTML = data.map((s, i) => {
        const cls = s.status === 'present' ? 'high' : s.status === 'late' ? 'mid' : 'low';
        return `
          <tr>
            <td style="color:var(--muted); font-family:'Rajdhani',sans-serif; font-size:0.85rem;">${String(i+1).padStart(2,'0')}</td>
            <td>
              <div class="student-cell">
                <div class="student-avatar" style="background:${s.color}20; border:1px solid ${s.color}40; color:${s.color}">${s.avatar}</div>
                <div>
                  <div class="student-name">${s.name}</div>
                  <div class="student-id">${s.id}</div>
                </div>
              </div>
            </td>
            <td>
              <span style="font-family:'Rajdhani',sans-serif; font-size:0.8rem; font-weight:700;
                color:${s.level==='ND I' ? 'var(--blue)' : 'var(--purple)'};
                background:${s.level==='ND I' ? 'var(--blue-glow)' : 'var(--purple-glow)'};
                border: 1px solid ${s.level==='ND I' ? 'rgba(96,165,250,0.2)' : 'rgba(167,139,250,0.2)'};
                padding:2px 8px; border-radius:4px;">${s.level}</span>
            </td>
            <td>
              <div class="status-badge ${s.status}">
                <div class="status-dot"></div>
                ${s.status.charAt(0).toUpperCase()+s.status.slice(1)}
              </div>
            </td>
            <td class="time-cell">${s.time}</td>
            <td>
              <div class="attend-pct ${cls}">${s.pct}%</div>
              <div class="pct-bar-wrap"><div class="pct-bar ${cls}" style="width:${s.pct}%"></div></div>
            </td>
          </tr>`;
      }).join('');
      document.getElementById('tableCount').textContent = `Showing ${data.length} of ${students.length} students`;
    }

    function filterTable() { renderTable(); }
    function filterStatus(status, btn) {
      currentFilter = status;
      document.querySelectorAll('.filter-tab').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      renderTable();
    }

    // ===== DONUT =====
    function drawDonut() {
      const total = students.length;
      const present = students.filter(s => s.status === 'present').length;
      const absent = students.filter(s => s.status === 'absent').length;
      const late = students.filter(s => s.status === 'late').length;
      const r = 50, cx = 60, cy = 60;
      const circumference = 2 * Math.PI * r;
      const segments = [
        { val: present, color: '#4ADE80' },
        { val: late, color: '#F59E0B' },
        { val: absent, color: '#F87171' },
      ];
      let offset = 0;
      const svg = document.getElementById('donutSvg');
      svg.innerHTML = `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="rgba(255,255,255,0.04)" stroke-width="14"/>`;
      segments.forEach(seg => {
        const len = (seg.val / total) * circumference;
        const circle = document.createElementNS('http://www.w3.org/2000/svg','circle');
        circle.setAttribute('cx', cx); circle.setAttribute('cy', cy); circle.setAttribute('r', r);
        circle.setAttribute('fill', 'none'); circle.setAttribute('stroke', seg.color);
        circle.setAttribute('stroke-width', '14');
        circle.setAttribute('stroke-dasharray', `${len} ${circumference - len}`);
        circle.setAttribute('stroke-dashoffset', -offset);
        circle.setAttribute('stroke-linecap', 'butt');
        svg.appendChild(circle);
        offset += len;
      });
    }

    // ===== WEEK CHART =====
    function renderWeekChart() {
      const days = [
        { day:'Mon', pct:88, today:false },
        { day:'Tue', pct:92, today:false },
        { day:'Wed', pct:76, today:false },
        { day:'Thu', pct:95, today:true },
        { day:'Fri', pct:0,  today:false },
      ];
      const wrap = document.getElementById('weekBars');
      wrap.innerHTML = days.map(d => `
        <div class="week-bar-col">
          <div style="font-family:'Rajdhani',sans-serif; font-size:0.65rem; color:${d.today ? 'var(--teal)' : 'var(--muted)'}; font-weight:700; margin-bottom:4px; text-align:center;">
            ${d.pct > 0 ? d.pct + '%' : '—'}
          </div>
          <div class="week-bar-track">
            <div class="week-bar-fill ${d.today ? 'today' : 'teal'}" style="height:${d.pct}%"></div>
          </div>
          <div class="week-day ${d.today ? 'today' : ''}">${d.day}</div>
        </div>
      `).join('');
    }

    // ===== ACTIVITY =====
    function renderActivity() {
      const events = [
        { icon:'✅', type:'green', name:'Amina Bello',    action:'Signed in via fingerprint',  time:'08:12' },
        { icon:'✅', type:'green', name:'Kamalu Musa',     action:'Signed in via fingerprint',  time:'08:07' },
        { icon:'⚠️', type:'amber', name:'Yusuf Abdullahi', action:'Marked late — 9:44 AM',      time:'09:44' },
        { icon:'❌', type:'red',   name:'Fatima Ibrahim',  action:'Absent — no scan detected',  time:'—' },
        { icon:'✅', type:'green', name:'Aisha Sule',      action:'Signed in via fingerprint',  time:'07:58' },
      ];
      document.getElementById('activityFeed').innerHTML = events.map(e => `
        <div class="activity-item">
          <div class="activity-icon ${e.type}">${e.icon}</div>
          <div style="flex:1; min-width:0;">
            <div class="activity-name">${e.name}</div>
            <div class="activity-action">${e.action}</div>
          </div>
          <div class="activity-time">${e.time}</div>
        </div>
      `).join('');
    }

    // ===== SPARKLINES (Canvas) =====
    function drawSparklines() {
      const datasets = [
        { id:'spark1', data:[28,30,32,29,35,33,36], color:'#00D4AA' },
        { id:'spark2', data:[42,42,42,42,42,42,42], color:'#F59E0B' },
        { id:'spark3', data:[1,1,1,1,2,2,2],         color:'#60A5FA' },
        { id:'spark4', data:[6,4,5,7,3,4,5],          color:'#A78BFA' },
      ];
      datasets.forEach(ds => {
        const canvas = document.getElementById(ds.id);
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const W = canvas.offsetWidth || 160;
        const H = canvas.offsetHeight || 36;
        canvas.width = W; canvas.height = H;
        const min = Math.min(...ds.data), max = Math.max(...ds.data);
        const pts = ds.data.map((v,i) => ({
          x: (i / (ds.data.length-1)) * W,
          y: H - ((v - min) / (max - min + 0.001)) * H * 0.85 - H * 0.07
        }));
        ctx.clearRect(0,0,W,H);
        const grad = ctx.createLinearGradient(0,0,0,H);
        grad.addColorStop(0, ds.color + '40');
        grad.addColorStop(1, ds.color + '00');
        ctx.beginPath();
        ctx.moveTo(pts[0].x, pts[0].y);
        pts.slice(1).forEach(p => ctx.lineTo(p.x, p.y));
        ctx.lineTo(W, H); ctx.lineTo(0, H); ctx.closePath();
        ctx.fillStyle = grad; ctx.fill();
        ctx.beginPath();
        ctx.moveTo(pts[0].x, pts[0].y);
        pts.slice(1).forEach(p => ctx.lineTo(p.x, p.y));
        ctx.strokeStyle = ds.color; ctx.lineWidth = 1.5; ctx.stroke();
      });
    }

    // ===== ACTIONS =====
    function toggleLevel() {
      currentLevel = currentLevel === 'ND I' ? 'ND II' : 'ND I';
      document.getElementById('ctxLevel').textContent = currentLevel;
      document.getElementById('levelBadge').textContent = currentLevel;
      showToast(`Switched to ${currentLevel} view`);
    }

    function markAttendance() {
      showToast('📡 Fingerprint scanner activated — waiting for students...');
    }

    function showToast(msg) {
      const toast = document.getElementById('toast');
      toast.textContent = msg;
      toast.style.transform = 'translateY(0)';
      toast.style.opacity = '1';
      setTimeout(() => {
        toast.style.transform = 'translateY(100px)';
        toast.style.opacity = '0';
      }, 3000);
    }

    init();
  </script>
</body>
</html>
