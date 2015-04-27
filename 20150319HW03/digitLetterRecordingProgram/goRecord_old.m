% ��Ʀr�i������A�@�n���⦸�A�ΥH�˴� speaker-dependent DTW ���į�
% Roger Jang, 20020328, 20050314

% ====== �ˬd MATLAB ����
desiredVersion='6.5';
matlabVersion=version;
if ~strcmp(matlabVersion(1:3), desiredVersion)
	fprintf('��ĳ�ϥΪ����G%s\n', desiredVersion);
end

% ====== �����Ѽ�
duration = 2;
fs = 16000;
%nbits = 8; format = 'uint8';		% 8-bit
nbits = 16; format = 'int16';		% 16-bit
waveDir = '../waveFile';

if exist(waveDir, 'dir') ~= 7,
	fprintf('Making wave directory => %s\n', waveDir);
	mkdir(waveDir);
end

validInput=0;
while ~validInput
	name = input('�п�J�z���u�Ǹ��v�[�u�m�W�v�]�Ҧp�G921510�i���P�^�G', 's');
%	validName = name(find(name>=double('�@')));		% �O�d����G��r���u�@�v�O�̵u�������r
	validName = name(find(name>=double('0')));		% �O�d���^��M�Ʀr
	if length(validName)>=2, validInput=1; end
end
userDir = [waveDir, '/', validName]; 
if exist(userDir, 'dir') ~= 7,
	fprintf('Making personal wave directory => %s\n', userDir);
	mkdir(userDir);
end

% ====== ��X�Ҧ����Ʀr
allDigit = textread('digitLetter.txt', '%s', 'delimiter', '\n', 'whitespace', '');
% ====== ��X�w�������ɮ�
dirInfo = dir(waveDir);
deleteIndex = [];

for i=3:length(dirInfo)
	userDirtemp=[waveDir, '/',(dirInfo(i).name)];
	currentWaveFile = dir([userDirtemp, '\*.wav']); 

	for i=1:length(currentWaveFile),
		digit = currentWaveFile(i).name(1:end-4);
		index = strmatch(digit, allDigit, 'exact');
		if ~isempty(index),
			deleteIndex = [deleteIndex; index];
		end
	end
  
end

% ====== ���L�w�������q�W
allDigit(deleteIndex) = [];
digitNum = length(allDigit);
if ~isempty(deleteIndex),
	fprintf('�w�� %g �ӿ����ɮסC\n', length(deleteIndex));
end

% ======  Load "waverecord"
wavrecord(0.1*fs, fs, 'uint8');

for i=1:digitNum,
	waveFile = [userDir, '/',allDigit{i}, '.wav'];
	displayText=allDigit{i}(1); 
	message = sprintf('(%g/%g) ���U Enter ��A�Цb %g ����u%s�v�]�Y�n���L���y�A�Ы��un�v�A�� Enter�^�G', i, digitNum, duration, displayText);
	fprintf('%s', message);
	userInput = input('', 's');	% ���}���ⳡ���A�~�৹����ܯS����A�p�u�\�v�B�u�\�v���C
	if isempty(userInput),
		fprintf('������...  ');
		y = wavrecord(duration*fs, fs, format);
		y = double(y);			% Convert from a uint8 to double array
		y = (y-mean(y))/(2^nbits/2);	% Make y zero mean and unity maximum
		plot((1:length(y))/fs, y); grid on
		axis([-inf inf -1 1]);
		title(['Wave form of "', waveFile, '"']);
		wavwrite(y, fs, nbits, waveFile);
		fprintf('���������C�Y�����ĪG���z�Q�A�����R���ɮס]%s�^�Y�i�C\n\n', waveFile);
	end
end

fprintf('���ߡI���������I\n');