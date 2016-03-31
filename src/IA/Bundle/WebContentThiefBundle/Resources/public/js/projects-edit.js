
$(function () {
    $('#btnBrowse').on('click', function () {
        var browseUrl = $(this).attr('data-browserUrl') + '?url=' + encodeURIComponent($('#currentUrl').val())
        $('#remoteBrowser').attr('src', browseUrl);
    });

    $('#remoteBrowser').on('load', function () {
        var cssUrl = $(this).attr('data-browserCss');
        var head = $(this).contents().find("head");
        head.append($("<link/>", {rel: "stylesheet", href: cssUrl, type: "text/css"}));

        $('*', this.contentWindow.document).click(function (e) {
            e.preventDefault();
            e.stopPropagation();

            $('.parserMarker').removeClass('parserMarker');
            $(this).addClass('parserMarker');

            var xpath = getXPath(this);
            alert(xpath);
            //selectedtextbox.val(xpath)
        });
    });

});



/**
 * Gets an XPath for an element which describes its hierarchical location.
 */
function getXPath(element) {
    var paths = [];

    // Use nodeName (instead of localName) so namespace prefix is included (if any).
    for (; element && element.nodeType == 1; element = element.parentNode) {
        var index = 0;
        // EXTRA TEST FOR ELEMENT.ID
        if (element && element.id) {
            paths.splice(0, 0, '/*[@id="' + element.id + '"]');
            break;
        }

        for (var sibling = element.previousSibling; sibling; sibling = sibling.previousSibling) {
            // Ignore document type declaration.
            if (sibling.nodeType == Node.DOCUMENT_TYPE_NODE)
                continue;

            if (sibling.nodeName == element.nodeName)
                ++index;
        }

        var tagName = element.nodeName.toLowerCase();
        var pathIndex = (index ? "[" + (index + 1) + "]" : "");
        paths.splice(0, 0, tagName + pathIndex);
    }

    return paths.length ? "/" + paths.join("/") : null;
};

