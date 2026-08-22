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
                                            New waitlist signup
                                        </p>

                                        <p style="font-size: 15px; line-height: 1.55; color: #333965; margin: 0 0 20px;">
                                            Someone just joined the LoversNmore waitlist. Details below:
                                        </p>

                                        <table cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse; background: #f8f4ff; border-radius: 12px; margin: 0 0 20px;">
                                            <tr>
                                                <td style="font-weight: 700; color: #3c1897; width: 40%; padding: 12px 14px; border-bottom: 1px solid #ede4ff;">Name</td>
                                                <td style="color: #1a202c; padding: 12px 14px; border-bottom: 1px solid #ede4ff;"><?= e($fullName ?: '-') ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 700; color: #3c1897; padding: 12px 14px; border-bottom: 1px solid #ede4ff;">Email</td>
                                                <td style="color: #1a202c; padding: 12px 14px; border-bottom: 1px solid #ede4ff;"><?= e($email) ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 700; color: #3c1897; padding: 12px 14px; border-bottom: 1px solid #ede4ff;">City</td>
                                                <td style="color: #1a202c; padding: 12px 14px; border-bottom: 1px solid #ede4ff;"><?= e($city ?: '-') ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 700; color: #3c1897; padding: 12px 14px; border-bottom: 1px solid #ede4ff;">Priority</td>
                                                <td style="color: #1a202c; padding: 12px 14px; border-bottom: 1px solid #ede4ff;">#<?= e($priorityScore) ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: 700; color: #3c1897; padding: 12px 14px;">Signed up</td>
                                                <td style="color: #1a202c; padding: 12px 14px;"><?= e($signupDate ?: '-') ?></td>
                                            </tr>
                                        </table>

                                        <p style="font-size: 13px; color: #6b7280; margin: 0;">
                                            You're receiving this because you're configured as the admin contact.
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
