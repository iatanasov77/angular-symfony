
$(function () {
    $('#btnBrowse').on('click', function () {
        var browseUrl = $(this).attr('data-browserUrl') + '?url=' + encodeURIComponent($('#FormProject_url').val());
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
            $("#FormProject_xquery", parent.document).val(xpath);
        });
    });
    
    $('.fieldsContainer').duplicateFields({
        btnRemoveSelector: ".btnRemoveField",
        btnAddSelector:    ".btnAddField"
    });
    
    $('#btnSetXquery').on('click', function() {
        var xquery = $('#FormProject_xquery').val();
        if(!xquery.length)
            return;
        
        var fieldId = $('#FormProject_xqueryField').val();
        $('#'+fieldId).val(xquery);
    });
    
    $('#btnAddFields').on('click', function() {
        var projectId = $(this).attr('data-projectId');
        var fieldsetId = $('#FormProject_fieldset').val();
        var url = $(this).attr('data-addFieldsUrl');
        
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: url,
            data: {
                projectId: projectId,
                fieldsetId: fieldsetId
            },
            success: function(data) {
                document.location = document.location;
            }
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

