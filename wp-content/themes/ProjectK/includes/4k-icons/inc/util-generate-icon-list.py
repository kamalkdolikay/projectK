#!/usr/bin/python

import sys
# Uncomment if this will be used
# sys.exit()

cssdir = '../icons/css/'

from os import walk

# Get all font CSS files
fontCSSFiles = []
for (dirpath, dirnames, filenames) in walk(cssdir):
    fontCSSFiles.extend(filenames)
    break

# Get all the font class names
fontClasses = []
for file in fontCSSFiles:
    for line in open(cssdir + file,'r').readlines():
        if not line.__contains__(':before'):
            continue
        if line[0] != '.':
            continue
        fontClasses.append(line[1:line.index(':before')])

# Print as a PHP array
print "array("
for fontClass in fontClasses:
    print "\t\"" + fontClass + "\","
print ");"

# Print as js array
# sys.stdout.write("[")
# for fontClass in fontClasses:
#     sys.stdout.write('"' + fontClass + '",')
# sys.stdout.write("]")

# Form CSS class list
# for fontClass in fontClasses:
#     if fontClass.find('ls-') == 0:
#         sys.stdout.write(' .' + fontClass + ',')
