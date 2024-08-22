document.addEventListener("DOMContentLoaded", async () => {
    const parts = window.location.href.split("/");
    const city_select = document.getElementById("city");
    const brgys_select = document.getElementById("brgys");

    const city_id = parts?.[5] ?? city_select?.value ?? 0;
    const brgys_id = parts?.[6] ?? 0;
    // console.log(city_select.value);
    // for dynamic fetching. It fetches the baranggays according to city_id
    // it then populates the select input
    async function getData(city_id) {
        const url = `http://127.0.0.1:8000/api/brgys/by/city/${city_id ?? 0}`;
        console.log(url);

        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }
            const json = await response.json();
            populate_brgys_options(json.data);
        } catch (e) {
            console.error(e.message);
        }
    };

    getData(city_id);
    const populate_brgys_options = (options) => {

        for (const o of options) {
            const opt = document.createElement("option");
            opt.value = o.id;
            opt.innerHTML = o.name;
            opt.selected = brgys_id == o.id;
            brgys_select.appendChild(opt);
        }
    };

    document.getElementById("city").addEventListener("change", async (e) => {
        brgys_select.innerHTML = "";
        await getData(e.target.value);
    });
});