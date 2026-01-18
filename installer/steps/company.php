<?php
// Company information step.
$defaults = [
    'name' => '',
    'summary' => '',
    'industry' => '',
    'country' => '',
    'city' => '',
    'street' => '',
    'website' => '',
    'email' => '',
    'phone' => '',
    'rc' => '',
];
$values = array_merge($defaults, $formValues);
?>
<div>
    <h2 class="text-2xl font-semibold text-slate-900">Company Information</h2>
    <p class="mt-2 text-slate-600">Tell us about your organization so we can personalize the experience.</p>

    <form method="post" class="mt-6 grid gap-4" data-validate-form>
        <input type="hidden" name="action" value="save_company">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm font-medium text-slate-700">Company Name</label>
                <input type="text" name="name" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['name']); ?>" placeholder="Company name">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Company Description</label>
                <input type="text" name="summary" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['summary']); ?>" placeholder="Short summary">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Industry</label>
                <input type="text" name="industry" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['industry']); ?>" placeholder="e.g., ICT, Agriculture">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Country</label>
                <input type="text" name="country" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['country']); ?>" placeholder="Company headquarters">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">City</label>
                <input type="text" name="city" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['city']); ?>" placeholder="City/State">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Street Address</label>
                <input type="text" name="street" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['street']); ?>" placeholder="Street address">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Website</label>
                <input type="text" name="website" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['website']); ?>" placeholder="www.example.com">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Company Email</label>
                <input type="email" name="email" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['email']); ?>" placeholder="info@company.com">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Phone</label>
                <input type="text" name="phone" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['phone']); ?>" placeholder="+1 555 000 0000">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">RC Code (optional)</label>
                <input type="text" name="rc" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['rc']); ?>" placeholder="RC, BN, etc">
            </div>
        </div>
        <div class="flex flex-wrap gap-3 pt-4">
            <a href="?step=install" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-slate-600 hover:bg-slate-50">Back</a>
            <button type="submit" data-submit class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2 font-medium text-white shadow-sm hover:bg-blue-700">
                Save &amp; Continue
            </button>
        </div>
    </form>
</div>
