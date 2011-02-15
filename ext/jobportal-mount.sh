#!/usr/bin/env bash

# ==== Preface ====

# Mount jobportal as local drive.
# tsocksssh is just a thin wrapper around tsocks and its magic:
# 
# !/bin/sh
# tsocks ssh $@
# 
# Why? wwwdup.uni-leipzig.de can't be accessed from outside the university (UL).
# If you have any account within the UL network, you can socks-proxy any
# traffic to it. For HTTP its rather straightforward:
#
# ssh -D 12345 user@server.within.uni-leipzig.de
# 
# Then adjust (on OS X) the network preferences SOCKS PROXY settings.
# Done.
# 
# This might work for all Aqua-App-originated traffic as well, accoring to 
# http://bastardbanter.wordpress.com/2007/05/23/how-to-socksify-a-mac/
# 
# For Macfusion (https://github.com/mgorbach/macfusion2) this doesn't seemed
# the case. I suspect it just uses plain `sshfs-static` under the hood.

# SSHFSDelegate.m:41
# - (NSString *)executablePath {
#   return [[NSBundle bundleForClass:[self class]] 
#       pathForResource:@"sshfs-static" ofType:nil inDirectory:nil];
# }

# Just a simple `tsocks sshfs ...` wouldn't work either. Long description
# of a workaround can be found here: https://gist.github.com/826062

# ==== Installing tsocks on OS X ====

# To install tsocks on OS X, I used 
# https://github.com/pc/tsocks (here's a mirror: https://github.com/miku/tsocks)

#   Quick installation instructions for OS X:
#   - autoconf
#   - ./configure --prefix=/usr
#   - make
#   - sudo make install
#   - sudo vi /usr/bin/tsocks
#   - change LIBDIR to /usr/lib
#   - create /etc/tsocks.conf. See tsocks.conf.simple.example (will work with just IP changed).

# Our tsocks.conf looks like:

# # We can access 192.168.0.* directly
# local = 192.168.0.0/255.255.255.0
# 
# # Otherwise we use the server
# server = 127.0.0.1
# server_port = 12345

# ==== QUICK START ====

# 0) Make sure you have a working Macfusion installed (either via git checkout
#       or download; 
#       in particular we'll need `sshfs-static` standalone executable)
#
# 1) Install tsocks and adjust /etc/tsocks.conf (see above)
#
# 2) Start the local socks proxy, via:
# 
#   ssh -D 12345 user@server.within.uni-leipzig.de
# 
# 3) Create you tsocks ssh wrapper:
# 
#   echo -e '#!/bin/sh\ntsocks ssh $@' > ~/bin/tsocksssh
#   chmod +x ~/bin/tsocksssh
# 
# 4) Run this script. Done.

# ==== Adjust ============

USER=jobp
HOST=wwwdup.uni-leipzig.de
TARGET=/Volumes/wwwdup.uni-leipzig.de

# ========================

ERROR_LOG=/tmp/$(basename $0)-errors.log

if [ ! -d "$TARGET" ]; then
    echo "Creating mountpoint at $TARGET..."        
    mkdir -p "$TARGET"
else
    echo "Trying to umount $TARGET first..."
    umount -fv "$TARGET" 2> $ERROR_LOG
    echo "Creating mountpoint at $TARGET..."    
    mkdir -p "$TARGET"    
fi

# https://git.wiki.kernel.org/index.php/GitFaq#Why_does_git_clone.2C_git_pull.2C_etc._fail_when_run_on_a_partition_mounted_with_sshfs_.28FUSE.29.3F
sshfs -oauto_cache,reconnect,volname=$HOST -ossh_command=tsocksssh \
        -ocompression=yes -oworkaround=rename \
        $USER@$HOST: $TARGET 2> $ERROR_LOG

E_SSHFS=$?

if [ 0 -eq $E_SSHFS ]; then
    echo "Successfully mounted $USER@$HOST at $TARGET"
    cat <<'LAMBDASHUTTLE'
                       .-----. 
                       | |.-\ \ 
                       | ||_|\ \ 
                       | :   :  \ 
                       |  :___\  \    
                       | _|   :___\   
                       ||_|    \   \ 
                       ||_|    :    \ 
                       ||_| ____\____\ 
                       |   |    :     \ 
                       | _ |     \     \ 
                       || ||     :     / 
                       || /-``.    \   / 
                       '-((((_|_---'-' 
                      _)____`.__`. ________ 
                    ,'---.-. _...-/>._______. 
                ____|____|_<__ __(/ (`.      `. 
               / //    /   /,.\ | \  `._.------`. 
               \_\\____\___\`'/_.___>.._ `,------`. 
                 |''  | '(_)|)   ||_    ``'-------' 
                 |____|_____|    '--'--.---``' 
                /    /     /      \     \    \ 
               /    /    ,'        `.    `.   \ 
              /    /    /            \     \   \ 
             /    /   ,'             ``.    \   \ 
            /``-,.._ /                  \   ``.  \ 
           /   /   ,'                   ``.    \  \ 
          /   /   /                        \ ___\__\ 
         /   /  ,'                         ``. ____ \ 
        /   /  /                              \______\ 
       /``-/_ / 
      /``._ ,' 
     '-..__/
    
LAMBDASHUTTLE
# http://ascii-art.surfhome.de/content.php?id=sw
    if [ "Darwin" == `uname -s` ]; then
        echo "cd $TARGET" | pbcopy 
        echo
        # http://www.youtube.com/watch?v=Q7oqZ-_-O6Y#t=44s
        echo "You are cleared to proceed. Start you approach with CMD-V."
        echo
    fi
else
    echo "Could't mount $USER@$HOST at $TARGET"
    echo "sshfs said: $E_SSHFS"
    echo "Try to rerun the command once again."
fi

# EOF