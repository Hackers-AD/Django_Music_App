function ValidateForm() {
	npass=document.getElementById('npass').value;
	rpass=document.getElementById('rpass').value;
	pinfo=document.getElementById('pinfo');
	
	if (npass.length < 8) {
		pinfo.innerHTML="* Password length less than 8 not accepted.";
		pinfo.style.display="block";
		return false;
	}
	if (npass != rpass){
		pinfo.innerHTML="* Re-typed password doesn't matches choosen new password";
		pinfo.style.display="block";
		return false;
	}
	return true;
}