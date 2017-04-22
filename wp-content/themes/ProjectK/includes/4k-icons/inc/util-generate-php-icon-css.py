#!/usr/bin/python

import sys
# Uncomment if this will be used
#sys.exit()

cssdir = '../icons/css/'

from os import walk

# Get all font CSS files
fontCSSFiles = []
for (dirpath, dirnames, filenames) in walk(cssdir):
    fontCSSFiles.extend(filenames)
    break

# Create a list of all icons and their character
fontClasses = []
icons = {}
for file in fontCSSFiles:
    if file.__contains__('_'):
        continue
    print 'reading', file
    s = ''
    for line in open(cssdir + file,'r').readlines():
        s += line.replace('\n', '')
        continue
    s = s.split('}')
    for line in s:
        if not line.__contains__(':before'):
            continue
        if line[0] != '.':
            continue
        line = line.strip().replace("' ;", "';")
        name = line[1:line.index(':before')]
        icon = line[line.index('content: ') + len('content: ') + 1:line.index(';') - 1]
        icons[name] = icon

# print icons
# print len(icons)
# sys.exit()

# Print as a PHP array
f = open('icons.php', 'w')
f.write( "array(\n" )
for name, content in icons.iteritems():
    content = content.replace( "\\", "\\\\" )
    f.write( '\t"' + name + '" => "' + content + '",\n' )
f.write( ");\n" )
f.close()
# Print as js array
# sys.stdout.write("[")
# for fontClass in fontClasses:
#     sys.stdout.write('"' + fontClass + '",')
# sys.stdout.write("]")

# Form CSS class list
# for fontClass in fontClasses:
#     if fontClass.find('ls-') == 0:
#         sys.stdout.write(' .' + fontClass + ',')
