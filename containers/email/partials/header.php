<?php
$subjectLine = isset($subject) && $subject !== '' ? $subject : 'Notification';
?>
<table width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, sans-serif; background-color: #f6f8fb; padding: 20px;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background: #ffffff; border-radius: 6px; overflow: hidden;">
                <tr>
                    <td style="background: #1d4ed8; color: #ffffff; padding: 20px;">
                        <h2 style="margin: 0; font-size: 20px;"><?php echo $appName; ?></h2>
                        <p style="margin: 6px 0 0; font-size: 14px;"><?php echo $subjectLine; ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 24px;">
