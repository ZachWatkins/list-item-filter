var listfilter = {
  form: document.querySelector('form.listitem-filterbox'),
  init: null,
  ele: null,
  items: {
    eles: [],
    text: [],
  },
  handler: null,
  usetitles: null,
  preventSubmit: function(e){
    e.preventDefault();
    return false;
  }
}
listfilter.init = function(){
  // Collect the list items
  listfilter.items.eles = listfilter.form.parentNode.getElementsByTagName('li');
  if(listfilter.items.eles.length > 0){
    // Pull data attributes from form element
    listfilter.usetitles = (listfilter.form.dataset.lifbUseTitles === 'true');
    // Pass search text from elements to a stored array
    for(var i = 0; i < listfilter.items.eles.length; i++){
      var html = listfilter.items.eles[i].innerHTML,
          main = '',
          title = '',
          all = [];
      // Isolate main element text
      main = html.replace(/<[^<>]+>/g,'');
      // Isolate title attribute text
      if(listfilter.usetitles){
        // Isolate first title in html, replace commas with spaces, remove extra spaces
        title = html.match(/title="([^"]*)"/);
        if(title)
          title = title[1].replace(/\s*,\s*/g,' ').replace(/\s+/,' ');
      }
      // Combine text to be stored
      if(main != '')
        all.push(main);
      if(title != '')
        all.push(title);
      // Store text
      listfilter.items.text.push(all.join(' '));
    }
    // Initialize the search box
    listfilter.ele = listfilter.form.querySelector('input');
    listfilter.ele.addEventListener('keyup', listfilter.handler);
    // Prevent the form from being submitted
    listfilter.form.addEventListener('submit', listfilter.preventSubmit);
  }
};
listfilter.handler = function(e){
  var value = listfilter.ele.value,
      indexes = [],
      valuesToCheck = [];
  // Remove the commas and spaces at the ends of the search string
  value = value.replace(/^\s+/, '').replace(/\s+$/, '').replace(/,/g, '');
  if(value != ''){
    // If the search box has multiple words, search for them individually in addition to the whole value
    if(value.indexOf(' ') > 0){
      valuesToCheck = value.split(' ');
    }
    // Add the full value to the checked group
    valuesToCheck.push(value);
    // Loop through each item
    for(var i = 0; i < listfilter.items.text.length; i++){
      var itemtext = listfilter.items.text[i].toLowerCase(),
          found = false;
      for(var j = 0; j < valuesToCheck.length; j++){
        if(itemtext.indexOf(valuesToCheck[j]) >= 0){
          indexes.push(i);
          found = true;
          break;
        }
      }
      if(!found) {
        listfilter.items.eles[i].style.display = 'none';
      }
    }
    for(var i = 0; i < indexes.length; i++){
      listfilter.items.eles[indexes[i]].style.display = '';
    }
  }
};
window.addEventListener('load', listfilter.init);
