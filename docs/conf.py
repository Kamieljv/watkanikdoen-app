# Configuration file for the Sphinx documentation builder
import os
import sys
sys.path.insert(0, os.path.abspath('.'))

# -- Project information -----------------------------------------------------

project = 'Your Laravel Project Documentation'
copyright = '2022, Your Name'
author = 'Your Name'

# -- General configuration ---------------------------------------------------

root_doc = 'index'

source_parsers = {
    '.rst': 'restructuredtext',
    '.md': 'markdown',
}

source_suffix = ['.rst', '.md']

extensions = [
    'sphinx.ext.autodoc',
    'sphinx.ext.viewcode',
    'sphinx.ext.githubpages',
    'recommonmark',
]

# -- Options for HTML output -------------------------------------------------

# html_static_path = ['_static']

# -- Options for manual page output ------------------------------------------

man_pages = [
    ('index', 'yourproject', 'Your Laravel Project Documentation',
     [author], 1)
]
