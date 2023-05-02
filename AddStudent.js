
//Naming the button from the html id
const addButton = document.querySelector('#addStudent');

//where the magic happens
addButton.addEventListener('click', () => {

//getting values from the input text boxes in the html
const firstName = document.querySelector('#fname').value;
const lastName = document.querySelector('#lname').value;
const Age = document.querySelector('#age').value;
const Major = document.querySelector('#major').value;
const highSchoolYear = document.querySelector('#hsyear').value;
//getting the date to be just the day month year
const today = new Date();
const year = today.getFullYear();
const monthName = today.toLocaleString('default', { month: 'long' });
const day = today.getDate();
const dateSaved = year + " " + monthName + " " + day;
var idCounter = 0;

const db = indexedDB.open('studentData', 1);
console.log('database opened');

// Create object store
db.onupgradeneeded = function(event) {
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

//This will get us the highest ID value that way we aren't starting from 0 on a refreshed page
db.onsuccess = function(event) {
    console.log('how about now/');
    const db = event.target.result;
    const transaction = db.transaction('myObjectStore', 'readonly');
    const objectStore = transaction.objectStore('myObjectStore');
    const index = objectStore.index('IDIndex');
    console.log('is it in  yet?');
  
    const request = index.openCursor(null, 'prev');
  
    request.onsuccess = function(event) {
      const cursor = event.target.result;
      console.log('cursor');
      if (cursor) {
        const newestId = cursor.value.id;
        idCounter = newestId + 1; 
        console.log('Newest ID value:', idCounter);
        const idRequest = indexedDB.open('studentData', 1);

        // Add data to object store
        idRequest.onsuccess = function(event) {
            const db = event.target.result;
            const transaction = db.transaction('myObjectStore', 'readwrite');
            const objectStore = transaction.objectStore('myObjectStore');
            objectStore.put({ id: idCounter, firstName: firstName, lastName: lastName, Age: Age, Major: Major, HSYear: highSchoolYear, dateSaved: dateSaved });
            transaction.oncomplete = function() {
              console.log('Data added to object store');
            };
        };

      } else {
        console.log('No records found');
        const idRequest = indexedDB.open('studentData', 1);

        // Add data to object store
        idRequest.onsuccess = function(event) {
            const db = event.target.result;
            const transaction = db.transaction('myObjectStore', 'readwrite');
            const objectStore = transaction.objectStore('myObjectStore');
            objectStore.add({ id: idCounter, firstName: firstName, lastName: lastName, Age: Age, Major: Major, HSYear: highSchoolYear, dateSaved: dateSaved });
            transaction.oncomplete = function() {
              console.log('Data added to object store');
            };
        };
      }
    };


}
});