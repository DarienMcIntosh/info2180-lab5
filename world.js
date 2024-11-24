document.addEventListener("DOMContentLoaded", function () {
    const lookupButton = document.getElementById("lookup");
    const lookupCitiesButton = document.getElementById("lookupCities");
    const resultContainer = document.getElementById("result");

    lookupButton.addEventListener("click", async function () {
        await fetchData("countries");
    });

    lookupCitiesButton.addEventListener("click", async function () {
        await fetchData("cities");
    });

    async function fetchData(lookupType) {
        const countryInput = document.getElementById("country");
        const countryName = countryInput.value.trim();

        const url = `http://localhost/info2180-lab5/world.php?country=${encodeURIComponent(countryName)}&lookup=${lookupType}`;

    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`Error: ${response.status}`);
      }
      const data = await response.text();
      resultContainer.innerHTML = data;
    } catch (error) {
      console.error("Error:", error);
      resultContainer.innerHTML = "<p>Error retrieving data.</p>";
    }
  }
});


