/**
 * Marked config file
 */
import marked from 'marked'

// Optimization gfm task list -> checkbox type
let renderer = new marked.Renderer()
renderer.listitem = function(text) {
    let isTaskList = false
    if (/^<p>\[(x|v|\s)]\s*.*<\/p>/.test(text)) {
        text = text
            .replace(/^<p>\[ ]\s*(.*)<\/p>/, '<input type="checkbox" style="margin: 0 0.2em 0.25em -1.6em;vertical-align: middle;" disabled> ' + "$1")
            .replace(/^<p>\[(x|v)]\s*(.*)<\/p>/, '<input type="checkbox" style="margin: 0 0.2em 0.25em -1.6em;vertical-align: middle;" disabled checked> ' + "$2");
        isTaskList = true
    }
    if (/^\s*\[(x|v|\s)]\s*/.test(text)) {
        text = text
            .replace(/^\s*\[ ]\s*/, '<input type="checkbox" style="margin: 0 0.2em 0.25em -1.6em;vertical-align: middle;" disabled> ')
            .replace(/^\s*\[(x|v)]\s*/, '<input type="checkbox" style="margin: 0 0.2em 0.25em -1.6em;vertical-align: middle;" disabled checked> ');
        isTaskList = true
    }
    if (false === isTaskList) {
        return '<li>' + text + '</li>'
    } else {
        return '<li style="list-style: none">' + text + '</li>'
    }
};

let highlight = function (code) {
    return require('highlight.js').highlightAuto(code).value
}

// Setting marked options
marked.setOptions({
    renderer: renderer,
    gfm: true,
    breaks: true,
    sanitize: false,
    smartLists: true,
    highlight: highlight
})

module.exports = marked