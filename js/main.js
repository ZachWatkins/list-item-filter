var listfilter = {
  init: null,
  form: document.querySelector('.search-form.listitem-filterbox'),
  ele: null,
  items: {
    eles: [],
    text: [],
  },
  handler: null
}
listfilter.init = function(){
  // Collect the list items
  listfilter.items.eles = listfilter.form.parentNode.getElementsByTagName('li');
  if(listfilter.items.eles.length > 0){
    for(var i = 0; i < listfilter.items.eles.length; i++){
      var html = listfilter.items.eles[i].innerHTML;
      // Remove HTML elements from text
      html = html.replace(/<[^<>]+>/g,'');
      // Store text
      listfilter.items.text.push(html);
    }
    // Initialize the search box
    listfilter.ele = listfilter.form.querySelector('input');
    listfilter.ele.addEventListener('keyup', listfilter.handler);
  } else {
    // Remove the form since we don't have list items to filter
    listfilter.form.parentNode.removeChild(listfilter.form);
  }
};
listfilter.handler = function(e){
  var value = listfilter.ele.value,
      indexes = [],
      valuesToCheck = [];
  // Replace the spaces at the ends of the search string
  value = value.replace(/^\s+/, '').replace(/\s+$/, '');
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
