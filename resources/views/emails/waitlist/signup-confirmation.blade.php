<?php
    $webSiteName = 'LoversNmore';
?>
<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
                        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0"
                            role="presentation">
                            <tr>
                                <td class="content-cell">
                                    <div class="f-fallback">
                                        <p style="font-size: 20px; font-weight: 700; color: #1a202c; margin: 0 0 16px;">
                                            Hi <?= e($firstName) ?>,
                                        </p>

                                        <p style="font-size: 16px; line-height: 1.55; color: #333965; margin: 0 0 16px;">
                                            You're officially on the <strong><?= e($webSiteName) ?></strong> waitlist for Houston. We're excited to have you.
                                        </p>

                                        <p style="font-size: 16px; line-height: 1.55; color: #333965; margin: 0 0 16px;">
                                            We're building something different: a way to meet people with intention, build meaningful relationships, and discover experiences that bring you closer.
                                        </p>

                                        <p style="font-size: 16px; line-height: 1.55; color: #333965; margin: 0 0 16px;">
                                            <strong>What happens next?</strong>
                                        </p>

                                        <ul style="font-size: 16px; line-height: 1.6; color: #333965; margin: 0 0 20px; padding-left: 20px;">
                                            <li>We'll email you the moment we launch in Houston.</li>
                                            <li>You'll get first access before we open to the general public.</li>
                                            <li>Occasional updates on what we're building. Nothing spammy.</li>
                                        </ul>

                                        <p style="font-size: 16px; line-height: 1.55; color: #333965; margin: 0 0 16px;">
                                            Add us to your contacts so we don't land in spam.
                                        </p>

                                        <p style="font-size: 16px; line-height: 1.55; color: #333965; margin: 24px 0 0;">
                                            Talk soon,<br>
                                            The <?= e($webSiteName) ?> Team ♥
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
