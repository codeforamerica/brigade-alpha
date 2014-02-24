Brigade Alpha
=============

We’ve started work on the [new Brigade website](http://codeforamerica.github.io/brigade-alpha). It is still very much a work in progress, yet we share early and often around here. The site at this repository is intended to eventually replace the [CfA Brigade site](http://brigade.codeforamerica.org).

We have a few main goals with this early prototype:

1. Clearly explain what the Brigade is.
2. Show off the activities and stories of the Brigades.
3. Make it easy to find a local Brigade.
4. Make it easy to join a Brigade.

Tech
----
This site is hosted on GitHub Pages. It is entirely html, css, and javascript.

The data about the Brigades will soon come from the Civic Tech Movement API. The work on that project is happening under the [civic-json-worker](https://github.com/codeforamerica/civic-json-worker) repository. At the moment, it's still pulling data from the old Brigade site database.

Tools
-----
This repo includes a few tools that we are building to support the Brigades activities. They may be pulled into their own repos as development continues.

1. [Story Bucket](http://codeforamerica.github.io/brigade-alpha/story-bucket) - A simple madlib style storytelling form. All the stories told here will show up on the Brigade site. A few hand picked stories will show up on the [Code for America](http://codeforamerica.org) homepage. We hope that other tools we make will automatically create stories as well.
2. [Attendance Register](http://codeforamerica.github.io/brigade-alpha/attendance-register) - A quick form to help Brigades take attendance at events. It remembers what Brigade and event you are at.
 
Contacts
--------

* Andrew Hyder ([ondrae](https://github.com/ondrae))
* Frances Berriman ([phae](https://github.com/phae))
* Michal Migurski ([migurski](https://github.com/migurski))


## <a name="contributing"></a>Contributing
In the spirit of [free software][free-sw], **everyone** is encouraged to help
improve this project.

[free-sw]: http://www.fsf.org/licensing/essays/free-sw.html

Here are some ways *you* can contribute:

* by using alpha, beta, and prerelease versions
* by reporting bugs
* by suggesting new features
* by translating to a new language
* by writing or editing documentation
* by writing specifications
* by writing code (**no patch is too small**: fix typos, add comments, clean up
  inconsistent whitespace)
* by refactoring code
* by closing [issues][]
* by reviewing patches
* [financially][]

[issues]: https://github.com/codeforamerica/brigade-alpha/issues
[financially]: https://secure.codeforamerica.org/page/contribute

## <a name="issues"></a>Submitting an Issue
We use the [GitHub issue tracker][issues] to track bugs and features. Before
submitting a bug report or feature request, check to make sure it hasn't
already been submitted. You can indicate support for an existing issue by
voting it up. When submitting a bug report, please include a [Gist][] that
includes a stack trace and any details that may be necessary to reproduce the
bug.

[gist]: https://gist.github.com/

## <a name="pulls"></a>Submitting a Pull Request
1. Fork the project.
2. Create a topic branch.
3. Implement your feature or bug fix.
4. Commit and push your changes.
5. Submit a pull request.

## <a name="copyright"></a>Copyright
Copyright (c) 2014 Code for America. Still debating the license we use.



