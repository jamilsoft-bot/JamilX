# Manual QA Checklist: Invoice, Billing, Forum Services

## Invoice Service
### Happy paths
- Create a client and verify it appears in the client list.
- Create a new invoice with multiple line items and confirm totals.
- Edit an invoice and verify recalculated totals and status.
- Print invoice view and confirm layout is readable.
- Send invoice email (when mail is configured).

### Permissions
- Access invoice list when logged out → redirected to login.
- Non-admin cannot access settings.
- Non-owner cannot access invoices created by another user.

### Validation
- Missing client or line items blocks invoice creation.
- Invalid email is rejected for client form.
- Invalid CSRF token is rejected on POST.

### Security
- Verify user input is HTML-escaped in listings.
- Try XSS in line item descriptions and confirm it is escaped.

## Billing Service
### Happy paths
- Record payment for an invoice and confirm balance updates.
- Record partial payment and verify invoice status changes to Partially Paid.
- Refund a payment and verify balance updates.
- View billing dashboard totals.

### Permissions
- Access billing dashboard when logged out → redirected to login.

### Validation
- Payment amount must be > 0.
- Refund amount cannot exceed payment balance.
- Invalid CSRF token is rejected on POST.

### Security
- Ensure notes are escaped in views.

## Forum Service
### Happy paths
- Browse forum categories.
- Create a new topic and verify it appears in the category list.
- Reply to a topic and verify reply count changes.
- Search topics by keyword.

### Permissions
- Guests can browse categories and topics (if enabled by session state).
- Logged-in users can create topics/replies.
- Moderators/admin can lock/pin topics and delete posts.

### Validation
- Empty topic title/body blocked.
- Empty replies blocked.
- Invalid CSRF token is rejected on POST.

### Security & Abuse
- Post throttling triggers when posting too rapidly.
- Ensure content is HTML-escaped and safe from XSS.
