//FILTER MENU HIDE/SHOW *******************************************************************************
const filterButton = document.querySelector('#filter-button');
const filterMenu = document.querySelector('#filterMenu');
filterMenu.style.display = 'none';
filterButton.addEventListener('click', function() {
    if (filterMenu.style.display === 'none') {
        filterMenu.style.display = 'inline';
      } else {
        filterMenu.style.display = 'none';
      }
});

//TABLE POPULATION*********************************************************************************
//open indexedDB
const request = indexedDB.open('studentData', 1);

request.onupgradeneeded = function(event){
    console.log('start create object store');
    const db = event.target.result;
    const objectStore = db.createObjectStore('myObjectStore', { keyPath: 'id' });
    console.log('object store created');
    objectStore.createIndex('IDIndex', 'id');
    objectStore.createIndex('firstNameIndex', 'firstName');
    objectStore.createIndex('lastNameIndex', 'lastName');
    objectStore.createIndex('majorIndex', 'Major');
    objectStore.createIndex('hsYearIndex', 'HSYear');
    console.log('new index created');
};

request.onsuccess = function(event) {
  const db = event.target.result;
  const transaction = db.transaction('myObjectStore', 'readonly');
  const objectStore = transaction.objectStore('myObjectStore');
  //open cursor
  const cursorRequest = objectStore.openCursor();

  cursorRequest.onsuccess = function(event) {
    const cursor = event.target.result;
    //goes through the items and appends them into the table
    if (cursor) {
      //create a new row
      const tableRow = document.createElement('tr');
      //create the cells to go in that row 
      const firstNameCell = document.createElement('td');
      const lastNameCell = document.createElement('td');
      const majorCell = document.createElement('td');
      const hsYearCell = document.createElement('td');
      const dateSavedCell = document.createElement('td');
      const viewButtonCell = document.createElement('td');   
      //create and set properties to the button
      const viewButton = document.createElement('button');
      viewButton.textContent = "View";
      viewButton.id = cursor.value.id;
      //populate the cells
      firstNameCell.textContent = cursor.value.firstName;
      lastNameCell.textContent = cursor.value.lastName      
      majorCell.textContent = cursor.value.Major;      
      hsYearCell.textContent = cursor.value.HSYear;
      dateSavedCell.textContent = cursor.value.dateSaved;
      viewButtonCell.appendChild(viewButton);      
      //append the cells to the row
      tableRow.appendChild(firstNameCell);
      tableRow.appendChild(lastNameCell);
      tableRow.appendChild(majorCell);
      tableRow.appendChild(hsYearCell);
      tableRow.appendChild(dateSavedCell);
      tableRow.appendChild(viewButtonCell);
      //append the row to the table
      document.querySelector('#mainTable tbody').appendChild(tableRow);
      //cursor continues
      cursor.continue();
    }
  };
};

//TABLE SEARCH *************************************************************************
//Name the button; make a listener
const searchButton = document.querySelector('#search-button');
searchButton.addEventListener('click', function (){

//get the search values
const searchQuery = document.querySelector('#input');

const table = document.getElementById('mainTable');
const rows = table.getElementsByTagName('tr');


  const searchTerm = searchQuery.value.toLowerCase();
  for (let i = 1; i < rows.length; i++) { // Skip the header row
    const cells = rows[i].getElementsByTagName('td');
    let rowMatch = false;
    for (let j = 0; j < cells.length; j++) {
      const cellText = cells[j].innerText.toLowerCase();
      if (cellText.includes(searchTerm)) {
        rowMatch = true;
        break;
      }
    }
    if (rowMatch) {
      rows[i].style.display = '';
    } else {
      rows[i].style.display = 'none';
    }
  };
});

//TABLE FILTER *****************************************************************************
const sortInput = document.getElementById('filter-Menu');

sortInput.addEventListener('input', function(){
    console.log(sortInput.value);
    //returning to original
    if(sortInput.value == 0){
        const table = document.getElementById('mainTable');

        while (table.rows.length > 1) {
          table.deleteRow(1);
        }
        const request = indexedDB.open('studentData', 1);
        console.log('db opened');
        request.onsuccess = function(event) {
            const db = event.target.result;
            const transaction = db.transaction('myObjectStore', 'readonly');
            const objectStore = transaction.objectStore('myObjectStore');
            //open cursor
            const cursorRequest = objectStore.openCursor();
          
            cursorRequest.onsuccess = function(event) {
              const cursor = event.target.result;
              //goes through the items and appends them into the table
              if (cursor) {
                //create a new row
                const tableRow = document.createElement('tr');
                //create the cells to go in that row 
                const firstNameCell = document.createElement('td');
                const lastNameCell = document.createElement('td');
                const majorCell = document.createElement('td');
                const hsYearCell = document.createElement('td');
                const dateSavedCell = document.createElement('td');
                const viewButtonCell = document.createElement('td');   
                //create and set properties to the button
                const viewButton = document.createElement('button');
                viewButton.textContent = "View";
                viewButton.id = cursor.value.id;
                //populate the cells
                firstNameCell.textContent = cursor.value.firstName;
                lastNameCell.textContent = cursor.value.lastName      
                majorCell.textContent = cursor.value.Major;      
                hsYearCell.textContent = cursor.value.HSYear;
                dateSavedCell.textContent = cursor.value.dateSaved;
                viewButtonCell.appendChild(viewButton);      
                //append the cells to the row
                tableRow.appendChild(firstNameCell);
                tableRow.appendChild(lastNameCell);
                tableRow.appendChild(majorCell);
                tableRow.appendChild(hsYearCell);
                tableRow.appendChild(dateSavedCell);
                tableRow.appendChild(viewButtonCell);
                //append the row to the table
                document.querySelector('#mainTable tbody').appendChild(tableRow);
                //cursor continues
                cursor.continue();
              }
            };
          };
    }

//I hate my life rn not even gonna lie

    //sorting from A-Z (first name)
    if (sortInput.value == 1){
    console.log('sorting from A-Z');
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("mainTable");
    switching = true;
    while (switching) {

      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[0];
        y = rows[i + 1].getElementsByTagName("TD")[0];
        // Check if the two rows should switch place:
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
}

//sorting from Z-A (first name)
if (sortInput.value == 2){ 
        console.log('sorting from Z-A');
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("mainTable");
        switching = true;
        while (switching) {
          switching = false;
          rows = table.rows;
          for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[0];
            y = rows[i + 1].getElementsByTagName("TD")[0];
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
            }
          }
          if (shouldSwitch) {

            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
          }
        }
    }

//sorting by Major
    if (sortInput.value == 3){
        console.log('sorting from major');
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("mainTable");
        switching = true;
        while (switching) {
    
          switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
              // Start by saying there should be no switching:
              shouldSwitch = false;
              /* Get the two elements you want to compare,
              one from current row and one from the next: */
              x = rows[i].getElementsByTagName("TD")[2];
              y = rows[i + 1].getElementsByTagName("TD")[2];
              // Check if the two rows should switch place:
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            }
            if (shouldSwitch) {
              /* If a switch has been marked, make the switch
              and mark that a switch has been done: */
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
            }
          }
        }
//sorting by high school year
    if (sortInput.value == 4){
        console.log('sorting from High School Year');
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("mainTable");
        switching = true;
        while (switching) {
    
          switching = false;
          rows = table.rows;
          /* Loop through all table rows (except the
          first, which contains table headers): */
          for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[3];
            y = rows[i + 1].getElementsByTagName("TD")[3];
            // Check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
              // If so, mark as a switch and break the loop:
              shouldSwitch = true;
              break;
            }
          }
          if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
          }
        }
    }        

});