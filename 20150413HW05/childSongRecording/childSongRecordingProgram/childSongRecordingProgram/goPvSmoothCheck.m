addpath /users/jang/matlab/toolbox/utility
addpath /users/jang/matlab/toolbox/sap
pvDir='..\waveFile\921510_�i���P';

opt.type='singing';
opt.maxPitch=80;
opt.maxPitchDiff=5;
opt.outputDir=tempname;

pvSmoothCheck(pvDir, opt);