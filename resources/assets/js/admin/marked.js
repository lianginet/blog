/**
 * Marked config file
 */
import marked from 'marked'

// Optimization gfm task list -> checkbox type
let renderer = new marked.Renderer()
renderer.listitem = function(text) {
    if (/^\s*\[[x|v]\]\s*/.test(text) || /^\s*\[ \]\s*/.test(text)) {
        text = text
            .replace(/^\s*\[ \]\s*/, '<input type="checkbox" style="margin: 0 0.2em 0.25em -1.6em;vertical-align: middle;" disabled> ')
            .replace(/^\s*\[[x|v]\]\s*/, '<input type="checkbox" style="margin: 0 0.2em 0.25em -1.6em;vertical-align: middle;" disabled checked> ');
        return '<li style="list-style: none">' + text + '</li>';
    } else {
        return '<li>' + text + '</li>';
    }
};
marked.setOptions({
    renderer: renderer,
    gfm: true,
    breaks: true,
    sanitize: false,
    smartLists: true
})

module.exports = marked