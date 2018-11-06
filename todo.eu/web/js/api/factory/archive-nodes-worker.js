import {backSVG, completeSVG, removeSVG} from "../logos/logos.js";
import Nodes from "./factory-nodes.js";
import Api from "../api-todo.js";

let api = new Api();


export default class Archives
{
    /**
     * @param context
     */
    static completed(context)
    {
        let url     = `${api._apiUrl + context.getAttribute('data-build')}`;
        let parent  = context.parentNode.parentNode.parentNode;

        let target  = (parent.id === 'todo') ? document.getElementById('completed')
            : document.getElementById('todo');

        try{
            let dts = api.chain('put', null, url);
            if(dts['error']){
                throw new Error(`Failed to UPDATE field.  ${dts['message']}`);
            } else {
                target.insertBefore(context.parentNode.parentNode, target.childNodes[0]);
            }
        } catch (e) {
            Nodes.errorsNodes(e.message);
        }
    }

    /**s
     * @param context
     */
    static delete(context)
    {
        let url     = `${api._apiUrl + context.getAttribute('data-build')}`;
        let target  = document.getElementById('archive');
        let item    = context.parentNode.parentNode;
        let buttons = context.parentNode;

        item.setAttribute('data-build', context.getAttribute('data-build'));

        try{
            let dts = api.chain('delete', null, url);
            if(dts['error']){
                throw new Error(`Could not REMOVE field.  ${dts['message']}`);
            } else {
                item.appendChild(Archives.archiveButtonsCreate( context.getAttribute('data-build')));
                target.insertBefore(item, target.childNodes[0]);
                item.removeChild(buttons);
            }
        } catch (e) {
            Nodes.errorsNodes(e.message);
        }
    }

    /**
     * @param context
     */
    static archiveButtonsDelete(context)
    {
        let id      = context.children[1].getAttribute('data-build');

        let parent  = context.parentNode.innerText;
        let content = parent.slice(0, (parent.length - 12));

        let item = Archives.createItem(content);
        let buttons = Archives.createButtonsWrapper();
        let remove = Archives.createRemoveButton(id);
        let complete = Archives.createCompleteButton(id);

        buttons.appendChild(remove);
        buttons.appendChild(complete);
        item.appendChild(buttons);

        try{
            let url     = `${api._apiUrl + context.children[1].getAttribute('data-build')}`;
            let dts = api.chain('put', null, url);

            if(dts['error']){
                throw new Error(`Failed to RETURN field. ${dts['message']}`);
            } else {
                context.parentNode.parentNode.removeChild(context.parentNode);
                document.getElementById('todo').insertBefore(item, document.getElementById('todo').childNodes[0]);
            }
        } catch (e) {
            Nodes.errorsNodes(e.message);
        }
    }

    /**
     * @param id
     * @returns {HTMLElement}
     */
    static archiveButtonsCreate(id)
    {
        let backButton = document.createElement('div');
        let button = document.createElement('button');
        let msg = document.createElement('span');

        button.setAttribute('id', 'button-back');
        button.setAttribute('data-build', id);
        button.innerHTML = backSVG;

        msg.setAttribute('id', 'back-msg');
        msg.innerText = 'give it back';

        backButton.appendChild(msg);
        backButton.appendChild(button);
        backButton.addEventListener('click', function(){
            Archives.archiveButtonsDelete(this);
        });

        backButton.setAttribute('id', 'back-buttons');

        return backButton;
    }

    /**
     * @param content
     * @returns {HTMLElement}
     */
    static createItem(content)
    {
        let item = document.createElement('li');

        item.innerText = content;
        return item;
    }

    /**
     * @returns {HTMLElement}
     */
    static createButtonsWrapper()
    {
        let buttons = document.createElement('div');

        buttons.classList.add('buttons');

        return buttons;
    }

    /**
     * @param id
     * @returns {HTMLElement}
     */
    static createRemoveButton(id)
    {
        let remove = document.createElement('button');

        remove.classList.add('remove');
        remove.setAttribute('data-build', id);
        remove.innerHTML = removeSVG;
        remove.addEventListener('click', function(){
            Archives.delete(this);
        });

        return remove;
    }

    /**
     * @param id
     * @returns {HTMLElement}
     */
    static createCompleteButton(id)
    {
        let complete = document.createElement('button');

        complete.classList.add('complete');
        complete.setAttribute('data-build', id);
        complete.innerHTML = completeSVG;
        complete.addEventListener('click', function(){
            Archives.completed(this);
        });

        return complete;
    }
}