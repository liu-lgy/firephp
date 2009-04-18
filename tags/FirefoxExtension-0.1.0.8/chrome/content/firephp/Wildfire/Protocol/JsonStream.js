        
Wildfire.Protocol.JsonStream = function() {

  this.PROTOCOL_URI = 'http://meta.wildfirehq.org/Protocol/JsonStream/0.1';
  
  this.plugins = new Array();
  this.plugin_ids = new Array();
  this.messages = new Array();
  this.structures = new Array();
  this.buffer = new Array();
  
  
  this.getURI = function()
  {
    return this.PROTOCOL_URI;
  };

  this.registerPlugin = function(Plugin) {
    for( var index in this.plugins ) {
      if(this.plugins==Plugin) {
        return false;
      }
    }
    this.plugins[Plugin.getURI()] = Plugin;
    return true;
  };

  this.receiveMessage = function(Key, Data) {
        
    var key = this.parseKey(Key);
      
    if(key[0]=='structure') {
      if(!this.structures[key[1]]) {
        this.structures[key[1]] = Data;
      }
    } else
    if(key[0]=='plugin') {
      if(!this.plugins[key[1]]) {
        this.plugin_ids[key[1]] = Data;
      }
    } else
    if(key[0]=='index') {

      /* TODO: Could ensure all messages were received here based on index */
     
      /* Flush the messages to the plugins */
     
      if(this.messages) {
        
        this.messages = this.sortMessages(this.messages);
        
        for( var index in this.messages ) {

          var plugin = this.plugins[this.plugin_ids[this.messages[index][0]]];

          if(this.messages[index][2].length==5000) {
            
            this.buffer.push(this.messages[index][2]);
                        
          } else
          if(this.buffer.length>0) {
          
            plugin.receivedMessage(index,
                                   this.structures[this.messages[index][1]],
                                   this.buffer.join('')+this.messages[index][2]);

            this.buffer = new Array();
          
          } else {
            plugin.receivedMessage(index,
                                   this.structures[this.messages[index][1]],
                                   this.messages[index][2]);
          }
        }
      }
      
      this.messages = new Array();
      
    } else {

      this.messages[key[2]] = [key[1],key[0],Data];
    }
 
    return true;
  };
  
  this.sortMessages = function(Messages) {
    array = new Array();
    var keys = new Array();
    for(k in Messages)
    {
         keys.push(k);
    }
    
    keys.sort( function (a, b){return (a > b) - (a < b);} );
    
    
    for (var i = 0; i < keys.length; i++)
    {
      array[keys[i]] = Messages[keys[i]];
    }    
    return array;
  }
  
  
  this.parseKey = function(Key) {
    return Key.toLowerCase().split('-');
  };

  
}