#!/usr/bin/env bash

JOBPORTAL_HOME=$HOME/projects/jobportal-uni-leipzig
WORKTREE_ON_SSHFS=$HOME/tmp/ccul

GIT_INDEX_FILE=$JOBPORTAL_HOME/.git/index \
GIT_WORK_TREE=$WORKTREE_ON_SSHFS \
# GIT_WORK_TREE=/sshfs-mount/on/production/server \
	git reset --hard
