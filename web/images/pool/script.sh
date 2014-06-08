#!/bin/bash
mogrify -resize 220x220! {*.png,*.jpg}
mogrify -format png  ephemeral:*.jpg
