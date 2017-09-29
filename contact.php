<?php include 'header.php';?>


<table width="100%" height="90%" cellspacing="0" cellpadding="0" valign="top">
	<tr><td width="90"> &nbsp; </td>
			<td class="header">Send Us A Note</td>
			<td width="90"> &nbsp; </td>
	</tr>
	<tr><td colspan="3" class="space">&nbsp;&nbsp; &nbsp;&nbsp;</td></tr>
	<tr><td width="90"> &nbsp; </td>
			<td valign="top" colspan="2">
					<form name="frm" action="./form/send.php" method="post" onsubmit="return validate(frm)">
						<table align="left" cellpadding="3">
							<tr><td align="right">First Name</td>
								<td align="right"><input type="text" name="first_name" class="input" size="45"></td>
							</tr>
							<tr><td align="right">Last Name</td>
								<td align="right"><input type="text" name="last_name" class="input" size="45"></td>
							</tr>

							<tr><td align="right">E-mail</td>
								<td align="right"><input name="email" class="input" size="45"></td>
							</tr>

							<tr><td align="right">Telephone Number</td>
								<td align="right"><input name="phone" class="input" size="45"></td>
							</tr>

							<tr><td align="right" colspan="2" class="footer">(We will not sell or distribute your address)</td></tr>

							<tr><td align="right" valign="top">Message | Inquiry</td>
								<td align="right" valign="bottom"><textarea cols="43" name="comment" class="input" rows="15"> </textarea></td>
							</tr>
							<tr><td> &nbsp; </td>
								<td align="right">
									<input type="submit" name="Submit" value="send message"> <input type="reset" name="Submit" value="clear">
								</td>
							</tr>
						</table>
					</form>
		</td>
	</tr>
	<tr><td colspan="3" class="w">&nbsp;&nbsp; &nbsp;&nbsp;</td></tr>
	<tr><td width="90"> &nbsp; </td>
			<td valign="top">
			<table align="left" cellspacing="2" cellpadding="1">
			<tr><td colspan="2" class="subheader">Voice Mail: &nbsp; 805.699.6851</td></tr>
			<tr><td colspan="2" class="space">&nbsp;</td></tr>
			<tr><td colspan="2" class="space">&nbsp;</td></tr>
			<tr><td class="subheader">Mailing Address:</td>	<td class="subheader">372 Puesta Del Sol</td></tr>
			<tr><td> &nbsp; </td> 													<td class="subheader">Arroyo Grande, California</td></tr>
			<tr><td colspan="2" class="space">&nbsp;</td></tr>
			<tr><td colspan="2" class="space">&nbsp;</td></tr>
			</table>
			</td>
			<td width="90"> &nbsp; </td>
	</tr>
	<tr><td colspan="3" class="w">&nbsp;&nbsp; &nbsp;&nbsp;</td></tr>
<!-- footer -->
	<tr><td colspan="3" class="space">&nbsp;&nbsp; &nbsp;&nbsp;</td></tr>
	<tr><td colspan="3" valign="bottom" align="center" class="footer">&copy; Widgital, All Rights Reserved.</td></tr>
	<tr><td colspan="3" class="w">&nbsp;&nbsp; &nbsp;&nbsp;</td></tr>
</table>

	<script language="javascript">
	function validate(frm) {
		var inputFields = new Array("first name" ,"last name" ,"formmail_mail_email");
		var counter;
		var name;
		var msg = "Please complete the following fields:\n";
		var badFields = "";
		for (counter = 0; counter < inputFields.length; counter++) {
			name = inputFields[counter];
			if (frm.elements[name].value.length == 0) {
				if (name == "formmail_mail_email") {
					badFields = badFields + "  - email address \n";
				} else {
					badFields = badFields + "  - " + name + "\n";
				}
			}
		}
		if (badFields.length != 0) {
			alert(msg + badFields);
			return false;
		}
		if (frm.formmail_mail_email.value.length > 0) {
			return emailCheck(frm.formmail_mail_email.value);
		} else {
			return true;
		}
	}

	function emailCheck(emailStr) {
		var emailPat=/^(.+)@(.+)$/;
		var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]";
		var validChars="\[^\\s" + specialChars + "\]";
		var quotedUser="(\"[^\"]*\")";
		var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
		var atom=validChars + '+';
		var word="(" + atom + "|" + quotedUser + ")";
		var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
		var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
		var matchArray=emailStr.match(emailPat);

		if (matchArray==null) {
			alert("Email address seems incorrect (check @ and .'s)");
			return false;
		}

		var user=matchArray[1];
		var domain=matchArray[2];

		if (user.match(userPat)==null) {
    			alert("The username doesn't seem to be valid.");
			return false;
		}

		var IPArray=domain.match(ipDomainPat);
		if (IPArray!=null) {
	  		for (var i=1;i<=4;i++) {
			    if (IPArray[i]>255) {
		        	alert("Destination IP address is invalid!");
				return false;
	 	   		}
    			}
    			return true;
		}

		var domainArray=domain.match(domainPat);
		if (domainArray==null) {
			alert("The domain name doesn't seem to be valid.");
    			return false;
		}

		var atomPat=new RegExp(atom,"g");
		var domArr=domain.match(atomPat);
		var len=domArr.length;
		if (domArr[domArr.length-1].length<2 || domArr[domArr.length-1].length>3) {
		   alert("The address must end in a three-letter domain, or two letter country.");
   			return false;
		}

		if (len<2) {
   			var errStr="This address is missing a hostname!";
			alert(errStr);
   		return false;
		}

 		return true;
	}
</script>
</body>
</html>
