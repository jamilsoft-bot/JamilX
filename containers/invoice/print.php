<?php
$pageTitle = 'Print Invoice';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo invoice_html($pageTitle); ?></title>
    <style>
        body { font-family: Arial, sans-serif; color: #0f172a; margin: 32px; }
        h1 { font-size: 24px; margin-bottom: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 24px; }
        th, td { border-bottom: 1px solid #e2e8f0; padding: 8px; text-align: left; font-size: 14px; }
        .summary { margin-top: 16px; text-align: right; }
        .summary div { margin-bottom: 4px; }
        .muted { color: #64748b; font-size: 12px; }
    </style>
</head>
<body>
    <h1>Invoice <?php echo invoice_html($invoice['invoice_number']); ?></h1>
    <div class="muted">Issued: <?php echo invoice_html($invoice['issue_date']); ?> | Due: <?php echo invoice_html($invoice['due_date'] ?: '—'); ?></div>

    <h2>Bill To</h2>
    <div><?php echo invoice_html($invoice['client_name']); ?></div>
    <div class="muted"><?php echo invoice_html($invoice['client_email']); ?></div>
    <div class="muted"><?php echo invoice_html($invoice['client_phone']); ?></div>
    <div class="muted"><?php echo invoice_html($invoice['client_address']); ?></div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Discount</th>
                <th>Tax</th>
                <th>Line Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo invoice_html($item['description']); ?></td>
                    <td><?php echo invoice_html($item['quantity']); ?></td>
                    <td>$<?php echo invoice_currency($item['unit_price']); ?></td>
                    <td>$<?php echo invoice_currency($item['discount']); ?></td>
                    <td>$<?php echo invoice_currency($item['tax']); ?></td>
                    <td>$<?php echo invoice_currency($item['line_total']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="summary">
        <div>Subtotal: $<?php echo invoice_currency($invoice['subtotal']); ?></div>
        <div>Discounts: $<?php echo invoice_currency($invoice['discount_total']); ?></div>
        <div>Tax: $<?php echo invoice_currency($invoice['tax_total']); ?></div>
        <div><strong>Total: $<?php echo invoice_currency($invoice['total']); ?></strong></div>
        <div>Amount Paid: $<?php echo invoice_currency($invoice['amount_paid']); ?></div>
        <div><strong>Balance Due: $<?php echo invoice_currency($invoice['balance_due']); ?></strong></div>
    </div>

    <?php if (!empty($invoice['notes'])): ?>
        <h3>Notes</h3>
        <p><?php echo invoice_html($invoice['notes']); ?></p>
    <?php endif; ?>
</body>
</html>
