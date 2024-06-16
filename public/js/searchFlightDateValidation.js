document.addEventListener("alpine:init", () => {
    Alpine.data("dateValidation", () => ({
        initializeDate(element) {
            const today = new Date().toISOString().split("T")[0];
            element.setAttribute("min", today);
        },
        validateDates() {
            const departureDateInput = document.getElementById("departureDate");
            const returnDateInput = document.getElementById("returnDate");
            const departureDate = departureDateInput.value;
            const returnDate = returnDateInput.value;

            // Ensure return date is later than departure date
            if (returnDate && returnDate < departureDate) {
                alert("Return date must be later than departure date.");
                returnDateInput.value = "";
            }

            return true;
        },
    }));
});
