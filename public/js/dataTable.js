// resources/js/dataTable.js

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll(".data-table").forEach((tableElement) => {
    if (tableElement && typeof simpleDatatables.DataTable !== "undefined") {
      const table = new simpleDatatables.DataTable(tableElement, {
        perPage: 5,
        labels: {
          placeholder: "Buscar...",
          perPage: "filas por página",
          noRows: "No se encontraron filas",
          info: "Mostrando {start} a {end} de {rows} filas",
          searchTitle: "Buscar en la tabla",
        },
        template: (options, dom) =>
          "<div class='" +
          options.classes.top +
          "'>" +
          "<div class='flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-3 rtl:space-x-reverse w-full sm:w-auto'>" +
          (options.paging && options.perPageSelect
            ? "<div class='" +
              options.classes.dropdown +
              "'>" +
              "<label>" +
              "<select class='" +
              options.classes.selector +
              "'></select> " +
              options.labels.perPage +
              "</label>" +
              "</div>"
            : "") +
          "<button type='button' class='flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto' data-dropdown-target='exportDropdown-" +
          dom.id +
          "'>" +
          "Export as" +
          "<svg class='-me-0.5 ms-1.5 h-4 w-4' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' viewBox='0 0 24 24'>" +
          "<path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m19 9-7 7-7-7' />" +
          "</svg>" +
          "</button>" +
          "<div id='exportDropdown-" +
          dom.id +
          "' class='z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700' data-popper-placement='bottom'>" +
          "<ul class='p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400' aria-labelledby='exportDropdownButton'>" +
          "<li>" +
          "<button class='export-csv group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
          "<span>Export CSV</span>" +
          "</button>" +
          "</li>" +
          "<li>" +
          "<button class='export-json group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
          "<span>Export JSON</span>" +
          "</button>" +
          "</li>" +
          "<li>" +
          "<button class='export-txt group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
          "<span>Export TXT</span>" +
          "</button>" +
          "</li>" +
          "<li>" +
          "<button class='export-sql group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
          "<span>Export SQL</span>" +
          "</button>" +
          "</li>" +
          "</ul>" +
          "</div>" +
          "</div>" +
          (options.searchable
            ? "<div class='" +
              options.classes.search +
              " relative'>" +
              "<input class='" +
              options.classes.input +
              " pl-10' placeholder='" +
              options.labels.placeholder +
              "' type='search' title='" +
              options.labels.searchTitle +
              "'" +
              (dom.id ? " aria-controls='" + dom.id + "'" : "") +
              ">" +
              "</div>"
            : "") +
          "</div>" +
          "<div class='" +
          options.classes.container +
          "'" +
          (options.scrollY.length
            ? " style='height: " +
              options.scrollY +
              "; overflow-Y: auto;'"
            : "") +
          "></div>" +
          "<div class='" +
          options.classes.bottom +
          "'>" +
          (options.paging
            ? "<div class='" + options.classes.info + "'></div>"
            : "") +
          "<nav class='" +
          options.classes.pagination +
          "'></nav>" +
          "</div>",
      });

      // Event listeners for export buttons
      tableElement.querySelector(".export-csv")?.addEventListener("click", () => {
        simpleDatatables.exportCSV(table, {
          download: true,
          lineDelimiter: "\n",
          columnDelimiter: ";",
        });
      });

      tableElement.querySelector(".export-json")?.addEventListener("click", () => {
        simpleDatatables.exportJSON(table, {
          download: true,
          space: 3,
        });
      });

      tableElement.querySelector(".export-txt")?.addEventListener("click", () => {
        simpleDatatables.exportTXT(table, {
          download: true,
        });
      });

      tableElement.querySelector(".export-sql")?.addEventListener("click", () => {
        simpleDatatables.exportSQL(table, {
          download: true,
          tableName: "export_table",
        });
      });
    }
  });
});
