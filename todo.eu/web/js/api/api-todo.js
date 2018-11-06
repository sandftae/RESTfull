export default class Api
{
    /**
     * @constructor
     */
    constructor()
    {
        this.xhr        = new XMLHttpRequest();
        this._apiUrl    = `http://todo.eu/api/v1/note/`;
    }

    /**
     *
     * @returns {Api}
     */
    check()
    {
        this.xhr.onreadystatechange = function(){
            if(this.readyState !== 4) {
                if(this.status === 404) {
                    return `file or resource not found`;
                }
            }
        };
        return this;
    }

    /**
     * @param       method
     * @param       url
     * @returns     {Api}
     */
    open(method, url)
    {
        this.xhr.open(
            method,
            (!url) ? this._apiUrl : url,
            false
        );
        return this;
    }

    /**
     * @returns     {Api}
     */
    headers()
    {
        this.xhr.setRequestHeader("Content-type", "application/json");
        return this;
    }

    /**
     * @param       data
     * @returns     {Api}
     */
    send(data)
    {
        this.xhr.send(data);
        return this;
    }

    /**
     * @returns {any}
     */
    parse()
    {
        return JSON.parse(this.xhr.responseText);
    }

    /**
     * @param       method
     * @param       data
     * @param       url
     * @returns     {any}
     */
    chain(method, data, url)
    {
        return this.check().open
        (
            method,
            url
        )
            .headers().send(data).parse();
    }
}