import re, requests
# import sys

# _username = sys.argv[1]
# _password = sys.argv[2]
# _imgType = sys.argv[3]
# _folderID = sys.argv[4]
_username = 'justatest'
_password = 'justatest'
_imgtype = 'gif'
_folderID = 'mg1gu7oztmz9'

s = requests.Session()
s.headers.update({'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0'})
s.post('http://share-links.biz/login', data = {'user': _username, 'pass': _password, 'submit': 'Login', 'remember_me': 1})
_body = s.get('http://share-links.biz/manage', params = {'search': _folderID}).text
_folder_number = re.search(r'<input type="checkbox" name="chkFolder\[\]" value="(\d+)" class="chkFolder vtext-middle" \/>', _body).group(1)
_body = s.post('http://share-links.biz/manage', data = {'op': 'stimg', 'chkFolder[]': _folder_number}).text
_imglink = re.search(r'http:\/\/stats\.share-links\.biz\/[0-9a-z]+\.', _body).group(0)
print(_imglink + _imgtype)
s.close()