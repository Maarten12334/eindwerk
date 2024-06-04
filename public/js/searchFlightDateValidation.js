document.addEventListener("DOMContentLoaded", function() {
    const departureDateInput = document.getElementById("departureDate");
    const returnDateInput = document.getElementById("returnDate");

    // Set minimum date for departure and return dates
    const today = new Date().toISOString().split("T")[0];
    departureDateInput.setAttribute("min", today);
    returnDateInput.setAttribute("min", today);

    // Ensure return date is later than departure date
    departureDateInput.addEventListener("change", function() {
        returnDateInput.setAttribute("min", this.value);
    });

    returnDateInput.addEventListener("change", function() {
        if (this.value < departureDateInput.value) {
            alert("Return date must be later than departure date.");
            this.value = "";
        }
    });
});

function validateDates() {
    const departureDate = document.getElementById("departureDate").value;
    const returnDate = document.getElementById("returnDate").value;

    if (returnDate && returnDate < departureDate) {
        alert("Return date must be later than departure date.");
        return false;
    }

    return true;
}