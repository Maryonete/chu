const blocDatesSelect = document.querySelector("div#blocDatesSelect");
const blocMedecin = document.querySelector("div#blocMedecin");
const stay_medecin = document.querySelector("select.stay_medecin");
const stay_speciality = document.querySelector("select.stay_speciality");

if (stay_speciality.value > 0 && stay_medecin.value > 0) {
  blocMedecin.classList.remove("d-none");
  blocDatesSelect.classList.remove("d-none");
}

// evenement sur liste des spécialités
window.addEventListener("load", function (event) {
  stay_speciality.addEventListener("change", getMedecins);
});
//evenement sur liste des médecins
window.addEventListener("click", function (event) {
  document.querySelector("#stay_medecin").addEventListener("change", getDates);
});

function getMedecins(event, staySpecialitySelected) {
  // Construire l'URL en fonction de la spécialité sélectionnée
  const url = `/${this.value}/medecins/`;
  axios
    .get(url)
    .then((response) => {
      const divmedecinList = document.querySelector("div#blocMedecinList");
      divmedecinList.textContent = ""; // Vider la liste existante

      // Afficher la liste des médecins et masquer le bloc de sélection des dates
      blocMedecin.classList.remove("d-none");
      divmedecinList.classList.remove("bg-warning");
      blocDatesSelect.classList.add("d-none");

      // Créer la liste déroulante des médecins
      var selectList = document.createElement("select");
      selectList.id = "stay_medecin";
      selectList.name = "stay[medecin]";

      // Gérer le cas où aucun médecin n'est disponible
      if (response.data.length == 0) {
        infoNoMedecin = document.createTextNode(
          "Aucun médecin n'est disponible dans cette spécialité"
        );
        divmedecinList.classList.add("bg-warning");
        divmedecinList.appendChild(infoNoMedecin);
        selectList.classList.add("d-none"); // Masquer la liste vide
      } else {
        // Option "Sélectionner un médecin" par défaut
        const option = document.createElement("option");
        option.value = "";
        option.text = "Veuillez sélectionner un médecin";
        selectList.appendChild(option);

        // Ajouter une option pour chaque médecin
        response.data.forEach((medecin) => {
          const option = document.createElement("option");
          option.value = medecin.id;
          option.text = medecin.name;
          selectList.appendChild(option);
        });
      }
      // Ajouter la liste déroulante à la zone d'affichage
      divmedecinList.appendChild(selectList);
    })
    .catch((error) => {
      console.error(url + " : " + error);
      window.alert("Une erreur s'est produite.");
    });
}
/**
     affiches bloc de selection dates

    */
function getDates(event) {
  const stay_medecin = document.querySelector("select#stay_medecin");
  event.preventDefault(); // associée à un événement JavaScript permet d'éviter tout autre traitement.
  console.log("Médecin selectionné : " + stay_medecin.value);

  var urlDaysOut = "/" + stay_medecin.value + "/notMedecinjson";
  console.log(urlDaysOut);
  axios
    .get(urlDaysOut)
    .then((response) => {
      // jours ou le médecins n'est pas disponible
      var array = [];
      if (response.data.length > 0) {
        array = response.data;
      }
      console.log(array);
      $(function () {
        $(".js-datepicker").datepicker({
          format: "yy-mm-dd",
          language: "fr",
          todayHighlight: true,
          todayBtn: "linked",
          daysOfWeekDisabled: [0, 6],
          changeMonth: true,
          changeYear: true,
          minDate: "+1D",
          maxDate: "+1Y",
          updateViewDate: true,
          closeText: "Fermer",
          prevText: "Précédent",
          nextText: "Suivant",

          monthNamesShort: [
            "Jan",
            "Fev",
            "Mar",
            "Avr",
            "Mai",
            "Jun",
            "Jul",
            "Aou",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],

          dayNamesShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
          dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
          weekHeader: "Sm",
          dateFormat: "dd/mm/yy",
          firstDay: 1,
          beforeShowDay: function (date) {
            var noWeekend = $.datepicker.noWeekends(date);
            var string = jQuery.datepicker.formatDate("yy-mm-dd", date);
            // console.log(string);
            if (noWeekend[0]) {
              return [array.indexOf(string) == -1];
            } else {
              return noWeekend;
            }
          },
        });
      });
      if (stay_medecin.value > 0) {
        blocDatesSelect.classList.remove("d-none");
      } else {
        blocDatesSelect.classList.add("d-none");
      }
    })
    .catch((error) => {
      console.error(url + " : " + error);
      window.alert("Une erreur s'est produite.");
    });
}
