<tbody>
    <tr>
    <td align="center" style="font-size: 25px;line-height: 27px;font-weight:700;color: #272727;text-decoration:none;letter-spacing:0px;padding: 0 45px;">
        Job Application
    </td>
    </tr>
    <tr>
    <td height="20" style="line-height: 20px;">&nbsp;</td>
    </tr>
    <tr>
        <td class="" align="" style="font-family: 'Open Sans', sans-serif;font-size: 14px;line-height:26px;color: #3b4357;padding: 0 45px 5px;">
          <b>Hi admin</b>
        </td>
    </tr>
    <tr>
    <td class="" align="" style="font-family: 'Open Sans', sans-serif;font-size: 14px;line-height:26px;color: #3b4357;padding: 0 45px;">
        <p>A new job application form was submitted</p>
    </td>
    </tr>
    <tr>
    <td class="" align="" style="font-family: 'Open Sans', sans-serif;font-size: 14px;line-height:26px;color: #3b4357;padding: 0 45px;">
        <p> <b>Name</b> <?php echo $args['fname'] . ' ' . $args['lname'] ?> </p>
    </td>
    </tr>
    <tr>
    <td class="" align="" style="font-family: 'Open Sans', sans-serif;font-size: 14px;line-height:26px;color: #3b4357;padding: 0 45px;">
        <p> <b>Email</b> <?php echo $args['email'] ?> </p>
    </td>
    </tr>
    <tr>
    <td class="" align="" style="font-family: 'Open Sans', sans-serif;font-size: 14px;line-height:26px;color: #3b4357;padding: 0 45px;">
        <p> <b>Resume</b> <a href="<?php echo $args['file_url'] ?>">Download here</a> </p>
    </td>
    </tr>
    <tr>
    <td class="" align="" style="font-family: 'Open Sans', sans-serif;font-size: 14px;line-height:26px;color: #3b4357;padding: 0 45px;">
        <p> <b>Subject</b> <?php echo $args['subject'] ?> </p>
    </td>
    </tr>
    <tr>
    <td class="" align="" style="font-family: 'Open Sans', sans-serif;font-size: 14px;line-height:26px;color: #3b4357;padding: 0 45px;">
        <p> <b>Message</b> <?php echo $args['message'] ?> </p>
    </td>
    </tr>

</tbody> <!-- Table Body End -->