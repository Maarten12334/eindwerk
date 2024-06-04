@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Search Flights') }}
    </h2>
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4 dark:text-white">Search Flights</h1>
        <form action="{{ route('flights.results') }}" method="GET" onsubmit="return validateDates()">
            <div class="form-group mb-6">
                <label for="origin" class="block mb-2 dark:text-white">Origin</label>
                <input type="text" name="origin" id="origin"
                    class="form-control w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="form-group mb-6">
                <label for="destination" class="block mb-2 dark:text-white">Destination</label>
                <input type="text" name="destination" id="destination"
                    class="form-control w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="form-group mb-6 flex space-x-4 items-center">
                <div class="flex space-x-4">
                    <div class="flex-shrink-0">
                        <label for="departureDate" class="block mb-2 dark:text-white">Departure Date</label>
                        <input type="date" name="departureDate" id="departureDate"
                            class="form-control w-auto p-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="flex-shrink-0">
                        <label for="returnDate" class="block mb-2 dark:text-white">Return Date (optional)</label>
                        <input type="date" name="returnDate" id="returnDate"
                            class="form-control w-auto p-2 border border-gray-300 rounded">
                    </div>
                </div>
                <div class="flex items-center ml-4">
                    <input type="checkbox" name="nonStop" id="nonStop" value= "1" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                    <label for="nonStop" class="ml-2 dark:text-white">Non-stop flights only</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded">Search</button>
        </form>
    </div>

    <script>
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
    </script>
@endsection
