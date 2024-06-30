function toggleForm(showId, hideIds) {
  const showForm = document.getElementById(showId);
  const hideForms = hideIds.map(id => document.getElementById(id));

  showForm.style.display = showForm.style.display === "none" || showForm.style.display === "" ? "block" : "none";

  hideForms.forEach(form => {
    form.style.display = showForm.style.display === "block" ? "none" : "block";
  });

  const form1 = document.getElementById('form1');
  const btnform1 = document.getElementById('btnform1');

  const form2 = document.getElementById('form2');
  const btnform2 = document.getElementById('btnform2');

  const form3 = document.getElementById('form3');
  const btnform3 = document.getElementById('btnform3');

  const form4 = document.getElementById('form4');
  const btnform4 = document.getElementById('btnform4');

  const form5 = document.getElementById('form5');
  const btnform5 = document.getElementById('btnform5');

  if (form1 && form1.style.display !== "none") {
    btnform1.classList.add("collapsible-active-button");
    btnform2.classList.remove("collapsible-active-button");
    btnform2.classList.add("collapsible-inactive-button");
    btnform3.classList.remove("collapsible-active-button");
    btnform3.classList.add("collapsible-inactive-button");
    btnform4.classList.remove("collapsible-active-button");
    btnform4.classList.add("collapsible-inactive-button");
    btnform5.classList.remove("collapsible-active-button");
    btnform5.classList.add("collapsible-inactive-button");

    form2.style.display = "none";
    form3.style.display = "none";
    form4.style.display = "none";
    form5.style.display = "none";
  } else if (form2 && form2.style.display !== "none") {
    btnform2.classList.add("collapsible-active-button");
    btnform1.classList.remove("collapsible-active-button");
    btnform1.classList.add("collapsible-inactive-button");
    btnform3.classList.remove("collapsible-active-button");
    btnform3.classList.add("collapsible-inactive-button");
    btnform4.classList.remove("collapsible-active-button");
    btnform4.classList.add("collapsible-inactive-button");
    btnform5.classList.remove("collapsible-active-button");
    btnform5.classList.add("collapsible-inactive-button");

    form1.style.display = "none";
    form3.style.display = "none";
    form4.style.display = "none";
    form5.style.display = "none";
  } else if (form3 && form3.style.display !== "none") {
    btnform3.classList.add("collapsible-active-button");
    btnform1.classList.remove("collapsible-active-button");
    btnform1.classList.add("collapsible-inactive-button");
    btnform2.classList.remove("collapsible-active-button");
    btnform2.classList.add("collapsible-inactive-button");
    btnform4.classList.remove("collapsible-active-button");
    btnform4.classList.add("collapsible-inactive-button");
    btnform5.classList.remove("collapsible-active-button");
    btnform5.classList.add("collapsible-inactive-button");

    form1.style.display = "none";
    form2.style.display = "none";
    form4.style.display = "none";
    form5.style.display = "none";
  } else if (form4 && form4.style.display !== "none") {
    btnform4.classList.add("collapsible-active-button");
    btnform1.classList.remove("collapsible-active-button");
    btnform1.classList.add("collapsible-inactive-button");
    btnform2.classList.remove("collapsible-active-button");
    btnform2.classList.add("collapsible-inactive-button");
    btnform3.classList.remove("collapsible-active-button");
    btnform3.classList.add("collapsible-inactive-button");
    btnform5.classList.remove("collapsible-active-button");
    btnform5.classList.add("collapsible-inactive-button");

    form1.style.display = "none";
    form2.style.display = "none";
    form3.style.display = "none";
    form5.style.display = "none";
  } else if (form5 && form5.style.display !== "none") {
    btnform5.classList.add("collapsible-active-button");
    btnform1.classList.remove("collapsible-active-button");
    btnform1.classList.add("collapsible-inactive-button");
    btnform2.classList.remove("collapsible-active-button");
    btnform2.classList.add("collapsible-inactive-button");
    btnform3.classList.remove("collapsible-active-button");
    btnform3.classList.add("collapsible-inactive-button");
    btnform4.classList.remove("collapsible-active-button");
    btnform4.classList.add("collapsible-inactive-button");
    
    form1.style.display = "none";
    form2.style.display = "none";
    form3.style.display = "none";
    form4.style.display = "none";
  }
}

window.onload = function() {
  const form1 = document.getElementById('form1');
  const form2 = document.getElementById('form2');
  const form3 = document.getElementById('form3');
  const form4 = document.getElementById('form4');
  const form5 = document.getElementById('form5');
  const btnform1 = document.getElementById('btnform1');
  const btnform2 = document.getElementById('btnform2');
  const btnform3 = document.getElementById('btnform3');
  const btnform4 = document.getElementById('btnform4');
  const btnform5 = document.getElementById('btnform5');
  
  form1.style.display = "block";
  form2.style.display = "none";
  form3.style.display = "none";
  form4.style.display = "none";
  form5.style.display = "none";
  btnform1.classList.add("collapsible-active-button");
  btnform2.classList.add("collapsible-inactive-button");
  btnform3.classList.add("collapsible-inactive-button");
  btnform4.classList.add("collapsible-inactive-button");
  btnform5.classList.add("collapsible-inactive-button");
};