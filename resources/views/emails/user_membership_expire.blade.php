@include('emails.commons.header')

<div class="block">
    <!-- body + signature + footnote -->
    <table width="100%" bgcolor="#f2f2f2" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="bigimage" style="width: 100% !important; line-height: 100% !important; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0;">
        <tbody>
            <tr>
                <td style="border-collapse: collapse;">
                    <table bgcolor="#ffffff" width="542" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                        <tbody>
                            <tr>
                                <td>
                                    <table width="502" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                        <tbody style="border-collapse: collapse;">
                                            <!-- Spacing -->
                                            <tr>
                                                <td width="100%" height="40" style="border-collapse: collapse;"></td>
                                            </tr>
                                            <!-- /Spacing -->
                                            <!-- start of body -->
                                            <tr>
                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 14.5px; color: #666666; text-align: left; line-height: 20px; border-collapse: collapse;">
                                                    <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                            <!-- title -->
                                                            <tr>
                                                                <td style="font-family: Helvetica; font-size: 24px; color: #494949; text-align: left; line-height: 20px; font-weight: bold; border-collapse: collapse;" st-title="rightimage-title" align="left">
                                                                    Hi {{ $user }},
                                                                </td>
                                                            </tr>
                                                            <!-- end of title -->
                                                            <!-- Spacing -->
                                                            <tr>
                                                                <td width="100%" height="40" style="border-collapse: collapse;"></td>
                                                            </tr>
                                                            <!-- /Spacing -->
                                                            <!-- content -->
                                                            <tr>
                                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 14.5px; color: #666666; text-align: left; line-height: 20px; border-collapse: collapse;" st-content="rightimage-paragraph" align="left">
                                                                    <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 14.5px; color: #666666; text-align: left; line-height: 20px; border-collapse: collapse;" st-content="rightimage-paragraph" align="left">
                                                                                    You are receiving this email because your subscription will be expired 3 days later.
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <!-- Spacing --><td width="100%" height="40" style="border-collapse: collapse;"></td>
                                                                            </tr>
                                                                            <tr>

                                                                                <td>
                                                                                    <table valign="middle" class="tablet-button" st-button="edit" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" cellspacing="0" cellpadding="0" border="0" align="center" height="30">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td style="border-top-left-radius: 2px; border-bottom-left-radius: 2px; border-top-right-radius: 2px; border-bottom-right-radius: 2px; background-clip: padding-box; font-size: 14px; font-family: Helvetica, arial, sans-serif; text-align: center; color: #ffffff; font-weight: 300; padding-left: 18px; padding-right: 18px; border-collapse: collapse; background: #4e1a3f;" width="auto" valign="middle" bgcolor="#4e1a3f" align="center" height="30">
                                                                                                    <span style="color: #ffffff; font-weight: bold;">
                                                                                                        <a style="color: #ffffff; text-align: center; text-decoration: none;" href="{{ $url }}">Resume Subscription</a>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <!-- Spacing --><td width="100%" height="40" style="border-collapse: collapse;"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 14.5px; color: #666666; text-align: left; line-height: 20px; border-collapse: collapse;" st-content="rightimage-paragraph" align="left">
                                                                                    If you have not requested to cancel your membership, please  <a style="color:#4e1a3f; text-decoration:none" href="{{ route('home') }}">contact us</a> immediately.
                                                                                </td>
                                                                            </tr>
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <!-- end of content -->
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- end of body -->
                                            <!-- Spacing -->
                                            <tr>
                                                <td width="100%" height="40" style="border-collapse: collapse;"></td>
                                            </tr>
                                            <!-- /Spacing -->
                                            <!-- start of signature -->
                                            <tr>
                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 14.5px; color: #666666; text-align: left; line-height: 20px; border-collapse: collapse;" st-content="rightimage-paragraph" align="left">
                                                    <br />Regards,<br />The {{ env('APP_NAME') }} Team
                                                </td>
                                            </tr>
                                            <!-- Spacing -->
                                            <tr>
                                                <td width="100%" height="40" style="border-collapse: collapse;"></td>
                                            </tr>
                                            <!-- /Spacing -->
                                            <!-- end of signature -->
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- end of body + signature + footnote -->
</div>

@include('emails.commons.footer')