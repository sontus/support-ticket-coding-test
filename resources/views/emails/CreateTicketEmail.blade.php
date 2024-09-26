<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket System</title>
</head>

<body bgcolor="#0f3462" style="margin-top:20px;margin-bottom:20px">
<!-- Main table -->
<table border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="white" width="650">
    <tr>
        <td>
            <!-- Child table -->
            <table border="0" cellspacing="0" cellpadding="0" style="color:#0f3462; font-family: sans-serif;">
                <tr>
                    <td>
                        <h2 style="text-align:center; margin: 0px; padding-bottom: 25px; margin-top: 25px;">
                            Support Ticket System
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>

                        <h2 style=" margin: 0px 40px;padding-bottom: 25px;line-height: 2; font-size: 15px;">New Support Ticket Open</h2>
                        <p style=" margin: 0px 40px;padding-bottom: 25px;line-height: 2; font-size: 15px;">Thank you for contacting our support team. A support ticket has now been opened for your request. You will be notified when a response is made by email. The details of your ticket are shown below.
                        </p>
                        <p style=" margin: 10px 32px;padding-bottom: 25px;line-height: 2; font-size: 15px;">Ticket ID: {{ $ticket->ticket_number }}</p>
                        <p style=" margin: 10px 32px;padding-bottom: 25px;line-height: 2; font-size: 15px;">User: {{ $ticket->user->name }}</p>
                        <p style=" margin: 10px 32px;padding-bottom: 25px;line-height: 2; font-size: 15px;">Email: {{ $ticket->user->email }}</p>
                        <p style=" margin: 10px 32px;padding-bottom: 25px;line-height: 2; font-size: 15px;">Subject: {{ $ticket->title }}</p>
                        <p style=" margin: 10px 32px;padding-bottom: 25px;line-height: 2; font-size: 15px;">Status: {{ $ticket->stauts }}</p>

                    </td>
                </tr>
                <tr>
                    <td >
                        <p style=" margin: 20px 32px;padding-bottom: 25px;line-height: 2; font-size: 15px;">You can view the ticket at any time at <a href="{{ route('tickets.show', $ticket->id) }}">{{ route('tickets.show', $ticket->id) }}</a> </p>
                    </td>
                </tr>

            </table>
            <!-- /Child table -->
        </td>
    </tr>
</table>
<!-- / Main table -->
</body>

</html>
