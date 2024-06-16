document.addEventListener("alpine:init", () => {
    Alpine.data("dateValidation", (departure, returnDate) => ({
        departure,
        returnDate,
        initializeDate(element) {
            const today = new Date().toISOString().split("T")[0];
            element.setAttribute(
                "min",
                this.departure
                    ? new Date(this.departure).toISOString().split("T")[0]
                    : today
            );
            element.setAttribute(
                "max",
                this.returnDate
                    ? new Date(this.returnDate).toISOString().split("T")[0]
                    : ""
            );
        },
        validateDates() {
            const checkInDate = document.getElementById("checkInDate");
            const checkOutDate = document.getElementById("checkOutDate");
            const manualCheckInDate = document.getElementById("arrival");
            const manualCheckOutDate = document.getElementById("departure");

            if (checkInDate.value && checkOutDate.value) {
                const checkIn = new Date(checkInDate.value);
                const checkOut = new Date(checkOutDate.value);
                const oneDay = 24 * 60 * 60 * 1000;

                if (checkOut <= checkIn) {
                    alert(
                        "Check-out date must be at least one day after the check-in date."
                    );
                    checkOutDate.value = new Date(checkIn.getTime() + oneDay)
                        .toISOString()
                        .split("T")[0];
                }
            }

            if (manualCheckInDate.value && manualCheckOutDate.value) {
                const checkIn = new Date(manualCheckInDate.value);
                const checkOut = new Date(manualCheckOutDate.value);
                const oneDay = 24 * 60 * 60 * 1000;

                if (checkOut <= checkIn) {
                    alert(
                        "Check-out date must be at least one day after the check-in date."
                    );
                    manualCheckOutDate.value = new Date(
                        checkIn.getTime() + oneDay
                    )
                        .toISOString()
                        .split("T")[0];
                }
            }
        },
    }));
});
