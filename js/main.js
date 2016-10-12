function Listitemfilter(form){
  this.form = form;
  this.ele = this.form.querySelector('input');
  this.usetitles = (this.form.dataset.lifUseTitles === 'true');

  var items = {
    eles: form.parentNode.getElementsByTagName('li'),
    text: []
  };

  this.init = function(){

    // Collect the list items
    if(items.eles.length > 0){

      // Pass search text from elements to a stored array
      for(var i = 0; i < items.eles.length; i++){

        var html = items.eles[i].innerHTML,
            main = '',
            title = '',
            all = [];

        // Isolate main element text
        main = html.replace(/<[^<>]+>/g,'');

        // Isolate title attribute text
        if(this.usetitles){

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
        items.text.push(all.join(' '));

      }

      // Initialize the search box
      this.ele.addEventListener('keyup', this.handler);

      // Prevent the form from being submitted
      this.form.addEventListener('submit', this.preventSubmit);

    }
  };

  this.handler = function(e){

    var value = e.target.value,
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

      // Loop through each stored item
      for(var i = 0; i < items.text.length; i++){

        var itemtext = items.text[i].toLowerCase(),
            found = false;

        // Loop through each word in the search string
        for(var j = 0; j < valuesToCheck.length; j++){

          if(itemtext.indexOf(valuesToCheck[j]) >= 0){

            indexes.push(i);
            found = true;
            break;

          }

        }

        // Hide unmatched stored items
        if(!found) {
          items.eles[i].style.display = 'none';
        }

      }

      // Reset stored items matched with search string
      for(var i = 0; i < indexes.length; i++){
        items.eles[indexes[i]].style.display = '';
      }

    }

  };

  this.preventSubmit = function(e){

    e.preventDefault();
    return false;

  };

  this.init();
}

// For each instance of shortcode, create new list filter object
(function(){

  var forms = document.querySelectorAll('form.list-item-filter');

  for(var i = 0; i < forms.length; i++){
    new Listitemfilter(forms[i]);
  }

})();
