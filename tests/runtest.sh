#!/bin/bash

path=$(dirname $(realpath $0))
${path}/../vendor/bin/phpunit $path
