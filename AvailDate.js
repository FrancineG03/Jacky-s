document.addEventListener("DOMContentLoaded", function() {
    // Function to populate year options
    function populateYears() {
      var yearSelect = document.getElementById("yearSelect");
      var currentYear = new Date().getFullYear();
      for (var year = currentYear; year <= currentYear + 10; year++) {
        var option = document.createElement("option");
        option.value = year;
        option.text = year;
        yearSelect.appendChild(option);
      }
    }
  
    // Function to populate month options
    function populateMonths() {
      var monthSelect = document.getElementById("monthSelect");
      var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      var currentMonth = new Date().getMonth();
      for (var i = currentMonth; i < months.length; i++) {
        var option = document.createElement("option");
        option.value = i;
        option.text = months[i];
        monthSelect.appendChild(option);
      }
    }
  
    // Function to populate the days based on selected year and month
    function populateDays(year, month) {
      var daysContainer = document.getElementById("daysContainer");
      // Clear previous days
      daysContainer.innerHTML = "";
  
      var daysInMonth = new Date(year, month + 1, 0).getDate();
      var firstDayOfMonth = new Date(year, month, 1).getDay();
  
      var row = document.createElement("tr");
      for (var i = 0; i < firstDayOfMonth; i++) {
        row.appendChild(document.createElement("td"));
      }
  
      var currentDate = new Date();
      var currentDay = currentDate.getDate();
      var currentYear = currentDate.getFullYear();
      var currentMonth = currentDate.getMonth();
  
      for (var day = 1; day <= daysInMonth; day++) {
        var cell = document.createElement("td");
        cell.textContent = day;
  
        if ((year < currentYear) || (year === currentYear && month < currentMonth) || (year === currentYear && month === currentMonth && day < currentDay)) {
          cell.classList.add("disabled");
          cell.addEventListener("click", function() {
            alert("You cannot select past dates.");
          });
        } else {
          cell.addEventListener("click", function() {
            var selectedCells = document.querySelectorAll(".selected");
            for (var i = 0; i < selectedCells.length; i++) {
              selectedCells[i].classList.remove("selected");
            }
            this.classList.add("selected");
          });
        }
  
        row.appendChild(cell);
  
        if (row.children.length % 7 === 0) {
          daysContainer.appendChild(row);
          row = document.createElement("tr");
        }
      }
  
      // Fill in the remaining empty cells
      while (row.children.length % 7 !== 0) {
        row.appendChild(document.createElement("td"));
      }
  
      daysContainer.appendChild(row);
    }
  
    // Function to populate hour options in military time format (HH:MM)
    function populateHourOptions(selectId, startHour = 0) {
      var select = document.getElementById(selectId);
      select.innerHTML = ""; // Clear previous options
      var currentHour = new Date().getHours();
      for (var hour = startHour; hour < 24; hour++) {
        if ((selectId === "fromHour" && hour >= currentHour) || selectId === "toHour") {
          var option = document.createElement("option");
          var hourText = hour < 10 ? "0" + hour : hour;
          option.value = hourText + ":00";
          option.text = hourText + ":00";
          select.appendChild(option);
        }
      }
    }
  
    // Initial population
    populateYears();
    populateMonths();
    populateHourOptions("fromHour", new Date().getHours());
    populateHourOptions("toHour", new Date().getHours() + 1); // Populate "to" dropdown starting from the next hour
  
    // Synchronize with system date and time
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    var currentMonth = currentDate.getMonth();
    var currentDay = currentDate.getDate();
    var currentHour = currentDate.getHours();
  
    document.getElementById("yearSelect").value = currentYear;
    document.getElementById("monthSelect").value = currentMonth;
    populateDays(currentYear, currentMonth);
  
    document.getElementById("fromHour").value = (currentHour < 10 ? "0" + currentHour : currentHour) + ":00";
    document.getElementById("toHour").value = ((currentHour + 1) < 10 ? "0" + (currentHour + 1) : (currentHour + 1)) + ":00";
  
    // Event listeners for changes in year and month selection
    document.getElementById("yearSelect").addEventListener("change", function() {
      var year = parseInt(this.value);
      var month = parseInt(document.getElementById("monthSelect").value);
      populateDays(year, month);
    });
  
    document.getElementById("monthSelect").addEventListener("change", function() {
      var year = parseInt(document.getElementById("yearSelect").value);
      var month = parseInt(this.value);
      populateDays(year, month);
    });
  
    // Event listener for submit button
    document.getElementById("submitAppointment").addEventListener("click", function() {
      var name = document.getElementById("name").value;
      var year = parseInt(document.getElementById("yearSelect").value);
      var month = parseInt(document.getElementById("monthSelect").value);
      var day = parseInt(document.querySelector(".selected").textContent);
      var fromHour = document.getElementById("fromHour").value;
      var toHour = document.getElementById("toHour").value;
      var adults = document.getElementById("adults").value;
      var children = document.getElementById("children").value;
      var menu = document.getElementById("menu").value;
      var eventType = document.getElementById("eventType").value;
      var venue = document.getElementById("venue").value;
  
      var appointmentDate = new Date(year, month, day, parseInt(fromHour.split(':')[0]), parseInt(fromHour.split(':')[1]));
      var currentDate = new Date();
      
      if (appointmentDate < currentDate) {
        alert("Please select a future date and time for your appointment.");
        return;
      }
  
      var appointmentDetails = "Appointment booked for:\n" + 
                               "Name: " + name + "\n" +
                               "Date: " + appointmentDate.toLocaleString() + "\n" +
                               "Number of Adults: " + adults + "\n" +
                               "Number of Children: " + children + "\n" +
                               "Menu: " + menu + "\n" +
                               "Type of Event: " + eventType + "\n" +
                               "Venue Location: " + venue;
  
      document.getElementById("appointmentDetails").textContent = appointmentDetails.replace(/\n/g, "\n");
      document.getElementById("popupForm").style.display = "block";
    });
  
    // Event listener for popup close button
    document.querySelector(".popup-content .close").addEventListener("click", function() {
      document.getElementById("popupForm").style.display = "none";
    });
  
    // Event listener for continue button
    document.getElementById("continueButton").addEventListener("click", function() {
      document.getElementById("popupForm").style.display = "none";
      // You can add further actions here
    });
  
    // Close popup if clicked outside of the content
    window.addEventListener("click", function(event) {
      if (event.target == document.getElementById("popupForm")) {
        document.getElementById("popupForm").style.display = "none";
      }
    });
  });
  