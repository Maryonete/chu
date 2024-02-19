import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import timepicker from "../js/jquery-timepicker.js";
import "../styles/calendar.scss";

function addStayToCalendar(cal) {
  id = cal.value;
  console.log("addStayToCalendar: " + id);

  if (id > 0) {
    let xmlHttp = new XMLHttpRequest();

    xmlHttp.onreadystatechange = () => {
      if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        let Data = JSON.parse(xmlHttp.responseText);
        console.log(Data);
        document.querySelector("input#calendar_title").value = Data[0].title;

        document.querySelector("textarea#calendar_description").value =
          Data[0].description;
      }
    };
    url = "/admin/" + id + "/stay";
    xmlHttp.open("get", url, true);
    xmlHttp.send(null);
  } else {
    document.querySelector("input#calendar_title").value = "";

    document.querySelector("textarea#calendar_description").value = "";
  }
}

document.addEventListener("DOMContentLoaded", () => {
  let medecin_event_limit_day = document.getElementById(
    "medecin_event_limit_day"
  ).value;

  var calendarEl = document.getElementById("calendar");
  let xmlHttp = new XMLHttpRequest();

  xmlHttp.onreadystatechange = () => {
    if (xmlHttp.readyState == 4) {
      if (xmlHttp.status == 200) {
        let evenements = JSON.parse(xmlHttp.responseText);

        // installation calendrier
        let calendar = new Calendar(calendarEl, {
          initialView: "dayGridMonth",
          navLinks: true,
          plugins: [
            interactionPlugin,
            dayGridPlugin,
            timeGridPlugin,
            listPlugin,
          ],
          locale: "fr",
          timeZone: "Europe/Paris",
          slotMinTime: "14:00",
          slotMaxTime: "17:00",

          headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
          },
          buttonText: {
            today: "Aujourd'hui",
            month: "Mois",
            week: "Semaine",
            day: "Jour",
            list: "Liste",
          },
          businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5],
            startTime: "14:00",
            endTime: "17:00",
          },

          themeSystem: "bootstrap5",

          close: "fa-times",
          prev: "fa-chevron-left",
          next: "fa-chevron-right",
          prevYear: "fa-angle-double-left",
          nextYear: "fa-angle-double-right",

          events: evenements,

          nowIndicator: true,
          editable: true,
          eventStartEditable: false,
          eventDurationEditable: false,
          selectable: true,

          dayCellClassNames: function (arg) {
            if (
              arg.isPast ||
              IsDateHasEvent(arg.date) > medecin_event_limit_day
            ) {
              $(
                '[data-date="' +
                  arg.date.toISOString().slice(0, 10).toString() +
                  '"]'
              ).css("backgroundColor", "#b3bac0");
            }
          },
          selectAllow: function (infos, mov) {
            var now = new Date();
            if (now > infos.start) {
              return false;
            }
            if (IsDateHasEvent(infos.start, infos) > medecin_event_limit_day) {
              return false;
            } else {
              return true;
            }
          },
          selectOverlap: function (event) {
            if (IsDateHasEvent(event.start) > medecin_event_limit_day) {
              return false;
            }
            return true;
          },

          select: function (info) {
            const deb = (document.querySelector("input.deb").value =
              info.startStr);
            const fin = (document.querySelector("input.fin").value =
              info.endStr);

            $("#startHeure").timepicker({
              maxTime: "17:00",
              minTime: "08:00",
              timeFormat: "H:i",
            });
            $("#endHeure").timepicker({
              maxTime: "17:00",
              minTime: "08:00",
              timeFormat: "H:i",
            });
            $("#rdvModal").modal("show");
          },
        });
        calendar.render();

        // nombre d'evenment par date
        function IsDateHasEvent(infos) {
          var newD = infos;

          var allEvents = [];
          allEvents = calendar.getEvents();
          var nb = 0;
          var newD = newD.toISOString().slice(0, 10);

          var event = $.grep(allEvents, function (v) {
            var start = v.start.toISOString().slice(0, 10);
            var end = v.end.toISOString().slice(0, 10);

            if (start <= newD && newD <= end) {
              nb++;
            }
          });

          return nb;
        }
      }
    }
  };

  var url = document.querySelector(".url").value;
  xmlHttp.open("get", url, true);
  xmlHttp.send(null);
});
