<div class="block">
    <!-- Start of footer -->
    <table cellspacing="0" cellpadding="0" width="100%" border="0" align="center" bgcolor="#f2f2f2">
        <!-- Spacing -->
        <tr>
            <td width="100%" height="40" style="border-collapse: collapse;"></td>
        </tr>
        <!-- /Spacing -->
        <tr>
            <!--[if (gte mso 9)|(IE)]>
            <td><table cellspacing="0" cellpadding="0" width="502" class="devicewidthinner" border="0" align="center"><tr>
            <![endif]-->
            <td valign="top" align="center" width="100%" style="padding-bottom:15px;">

                <table width="502" class="devicewidthinner"  border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <td align="center" style="padding:10px 10px 0px 10px;mso-line-height-rule:exactly;">
                            <span style="font-family:Arial, Helvetica, Sans serif; font-size:12px; line-height:12px; color:#666;">
                                {{ env('COMPANY_ADDRESS') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:10px 10px 0px 10px;mso-line-height-rule:exactly;">
                            <span style="font-family:Arial, Helvetica, Sans serif; font-size:12px; line-height:12px; color:#666;">
                                &copy; {{ date('Y') }} {{ env('APP_NAME') }}.
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
            <!--[if (gte mso 9)|(IE)]>
            </tr></table></td>
            <![endif]-->
        </tr>
    </table>
<!-- End of footer -->
</div>