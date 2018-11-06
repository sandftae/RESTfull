/**
 * Import all classes
 */

import  Api      from    "./api/api-todo.js";
import  Nodes    from    "./api/factory/factory-nodes.js";

/**
 * @type {Api}
 */
const api   = new Api();

/**
 * @type {Nodes}
 */
const nodes = new Nodes(api);

/**
 * add all notes to browser
 */
nodes.insert();


document.getElementById('add').addEventListener('click', function(){
    let value = document.getElementById('item').value;
    nodes.createNodes(value, false, 'todo');
    document.getElementById('item').value = '';
});

document.getElementById('item').addEventListener('keydown', function(e) {
    let value = this.value;

    if(e.code === 'Enter' && value) {
        nodes.createNodes(value, false, 'todo');
        document.getElementById('item').value = '';
    }
});