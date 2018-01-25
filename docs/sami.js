
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:Ilex" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Ilex.html">Ilex</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Ilex_Validation" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Ilex/Validation.html">Validation</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Ilex_Validation_HkidValidation" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Ilex/Validation/HkidValidation.html">HkidValidation</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Ilex_Validation_HkidValidation_Helper" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Ilex/Validation/HkidValidation/Helper.html">Helper</a>                    </div>                </li>                            <li data-name="class:Ilex_Validation_HkidValidation_HkidDigitCheck" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Ilex/Validation/HkidValidation/HkidDigitCheck.html">HkidDigitCheck</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Ilex.html", "name": "Ilex", "doc": "Namespace Ilex"},{"type": "Namespace", "link": "Ilex/Validation.html", "name": "Ilex\\Validation", "doc": "Namespace Ilex\\Validation"},{"type": "Namespace", "link": "Ilex/Validation/HkidValidation.html", "name": "Ilex\\Validation\\HkidValidation", "doc": "Namespace Ilex\\Validation\\HkidValidation"},
            
            {"type": "Class", "fromName": "Ilex\\Validation\\HkidValidation", "fromLink": "Ilex/Validation/HkidValidation.html", "link": "Ilex/Validation/HkidValidation/Helper.html", "name": "Ilex\\Validation\\HkidValidation\\Helper", "doc": "&quot;Class Factory\nHelper for Quick check&quot;"},
                                                        {"type": "Method", "fromName": "Ilex\\Validation\\HkidValidation\\Helper", "fromLink": "Ilex/Validation/HkidValidation/Helper.html", "link": "Ilex/Validation/HkidValidation/Helper.html#method_checkByParts", "name": "Ilex\\Validation\\HkidValidation\\Helper::checkByParts", "doc": "&quot;Quick Helper check HKID Format eg. CA182361(1).&quot;"},
                    {"type": "Method", "fromName": "Ilex\\Validation\\HkidValidation\\Helper", "fromLink": "Ilex/Validation/HkidValidation/Helper.html", "link": "Ilex/Validation/HkidValidation/Helper.html#method_checkByString", "name": "Ilex\\Validation\\HkidValidation\\Helper::checkByString", "doc": "&quot;Quick Helper check HKID Format eg. CA182361(1).&quot;"},
            
            {"type": "Class", "fromName": "Ilex\\Validation\\HkidValidation", "fromLink": "Ilex/Validation/HkidValidation.html", "link": "Ilex/Validation/HkidValidation/HkidDigitCheck.html", "name": "Ilex\\Validation\\HkidValidation\\HkidDigitCheck", "doc": "&quot;Class HkidDigitCheck&quot;"},
                                                        {"type": "Method", "fromName": "Ilex\\Validation\\HkidValidation\\HkidDigitCheck", "fromLink": "Ilex/Validation/HkidValidation/HkidDigitCheck.html", "link": "Ilex/Validation/HkidValidation/HkidDigitCheck.html#method___construct", "name": "Ilex\\Validation\\HkidValidation\\HkidDigitCheck::__construct", "doc": "&quot;HkidDigitCheck constructor.&quot;"},
                    {"type": "Method", "fromName": "Ilex\\Validation\\HkidValidation\\HkidDigitCheck", "fromLink": "Ilex/Validation/HkidValidation/HkidDigitCheck.html", "link": "Ilex/Validation/HkidValidation/HkidDigitCheck.html#method_checkParts", "name": "Ilex\\Validation\\HkidValidation\\HkidDigitCheck::checkParts", "doc": "&quot;check by part&quot;"},
                    {"type": "Method", "fromName": "Ilex\\Validation\\HkidValidation\\HkidDigitCheck", "fromLink": "Ilex/Validation/HkidValidation/HkidDigitCheck.html", "link": "Ilex/Validation/HkidValidation/HkidDigitCheck.html#method_checkString", "name": "Ilex\\Validation\\HkidValidation\\HkidDigitCheck::checkString", "doc": "&quot;check whole string format and pattern&quot;"},
                    {"type": "Method", "fromName": "Ilex\\Validation\\HkidValidation\\HkidDigitCheck", "fromLink": "Ilex/Validation/HkidValidation/HkidDigitCheck.html", "link": "Ilex/Validation/HkidValidation/HkidDigitCheck.html#method_validate", "name": "Ilex\\Validation\\HkidValidation\\HkidDigitCheck::validate", "doc": "&quot;break down the strong to part1,2,3&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


