import {removeSVG, completeSVG, backSVG} from "../logos/logos.js";
import Style from "../../styles/styles.js";
import Api from "../api-todo.js";
import Archives from "./archive-nodes-worker.js";

/**
 *
 * @type {Api}
 */
const api = new Api();


export default class Nodes
{
    /**
     * @param apiObj
     */
    constructor(apiObj)
    {
        this._api   = apiObj;
    }

    /**
     * @param   method
     * @param   data
     * @param   url
     * @returns {*}
     */
    add(method, data, url)
    {
        return this._api.chain(method,data, url);
    }

    /**
     * @returns {*}
     */
    get()
    {
        return this._api.chain('get');
    }

    /**
     * @param text
     * @param check
     * @param tag
     */
    createNodes(text, check, tag)
    {
        let id = 0;

        if(!check){
            let dts = null;

            try{
                dts = this.add('post', JSON.stringify(text), this._api._apiUrl);
                id = dts[0]['id'];
            } catch (e) {
                if(dts['error']) {
                    Nodes.errorsNodes(`Failed to ADD data. ${dts['message']}`, this);
                    return;
                }
            }
        } else {
            id = check;
        }

        let item        = this.createItem(text);
        let buttons     = this.createButtons();
        let remove      = this.createRemoveButton(id);
        let complete    = this.createCompletedButton(id);

        buttons         = this.combine(buttons, remove, complete);

        if(tag === 'archive') {
            item.appendChild(Archives.archiveButtonsCreate(id));
        } else {
            item.appendChild(buttons);
        }

        document.getElementById(tag).insertBefore
        (
            item, document.getElementById(tag).childNodes[0]
        );
    }

    /**
     * @param text
     * @returns {HTMLElement}
     */
    createItem(text)
    {
        let item = document.createElement('li');
        item.innerText = text;

        return item;
    }

    /**
     * @returns {HTMLElement}
     */
    createButtons()
    {
        let buttons = document.createElement('div');

        buttons.classList.add('buttons');

        return buttons;
    }

    /**
     * @param id
     * @returns {HTMLElement}
     */
    createRemoveButton(id)
    {
        let remove = document.createElement('button');

        remove.classList.add('remove');
        remove.setAttribute('data-build', id);
        remove.innerHTML = removeSVG;
        remove.addEventListener('click', this.delete);

        return remove;
    }

    /**
     * @param id
     * @returns {HTMLElement}
     */
    createCompletedButton(id)
    {
        let complete = document.createElement('button');

        complete.classList.add('complete');
        complete.setAttribute('data-build', id);
        complete.innerHTML = completeSVG;
        complete.addEventListener('click', this.completed);

        return complete;
    }

    /**
     * @param button
     * @param removes
     * @param completed
     * @returns {*}
     */
    combine(button, removes, completed)
    {
        button.appendChild(removes);
        button.appendChild(completed);

        return button;
    }

    /**
     * Add all data to browser
     */
    insert()
    {
        let result = this._api.chain('get', null, false);

        if(result['error']) {
            Nodes.errorsNodes(`Failed to LOAD data. ${result['message']}`, this);
            return;
        }

        this._api.chain('get', null, false).forEach(index =>  {
            if(index['delete_status'] === '1') {
                this.createNodes(index['message'], index['id'], 'archive');
            } else if(index['done_status'] === '1'){
                this.createNodes(index['message'], index['id'], 'todo');
            } else if (index['done_status'] === '0') {
                this.createNodes(index['message'], index['id'], 'completed');
            }
        });
    }

    /**
     * @param message
     * @param context
     */
    static errorsNodes(message, context = null)
    {
        let check = document.getElementById('error');
        let container = document.getElementById('container');

        check.style.cssText = Style.style();

        if(check.innerText === ''){
            check.innerText = message;
            container.insertBefore(check, container.firstChild)
        } else {
            check.innerText = message;
            container.insertBefore(check, container.firstChild)
        }

        let clear = (context) => {
            context.innerText = '';
            context.removeAttribute('style');
        };

        setTimeout(
            function () {
                clear(check);
            }, 3500);

        check.addEventListener('dblclick', function(){
            clearTimeout(test);
            this.innerText = '';
            this.removeAttribute('style');
        });
    }

    /**
     * 'Completed' status to element
     */
    completed()
    {
        let url     = `${api._apiUrl + this.getAttribute('data-build')}`;
        let parent  = this.parentNode.parentNode.parentNode;

        let target  = (parent.id === 'todo') ? document.getElementById('completed')
            : document.getElementById('todo');

        try{
            let dts = api.chain('put', null, url);
            if(dts['error']){
                throw new Error(`Failed to UPDATE field.  ${dts['message']}`);
            } else {
                target.insertBefore(this.parentNode.parentNode, target.childNodes[0]);
            }
        } catch (e) {
            Nodes.errorsNodes(e.message, this);
        }
    }

    /**
     * Removed element
     */
    delete()
    {
        let url     = `${api._apiUrl + this.getAttribute('data-build')}`;
        let target  = document.getElementById('archive');
        let item    = this.parentNode.parentNode;
        let buttons = this.parentNode;

        item.setAttribute('data-build', this.getAttribute('data-build'));

        try{
            let dts = api.chain('delete', null, url);
            if(dts['error']){
                throw new Error(` Could not REMOVE field.  ${dts['message']}`);
            } else {
                item.appendChild(Archives.archiveButtonsCreate( this.getAttribute('data-build')));
                target.insertBefore(item, target.childNodes[0]);
                item.removeChild(buttons);
            }
        } catch (e) {
            Nodes.errorsNodes(e.message, this);
        }
    }
}