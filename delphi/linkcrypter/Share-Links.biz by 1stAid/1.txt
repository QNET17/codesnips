var 
  Daten : TIdMultiPartFormDataStream; 
  s1,s2,UrlString : string; 
  Http : TIdHttp ; 
  match: TMatch; 
  sList: TStringList; 
begin 
UrlString:= AurlString; 
UrlString:= StringReplace(UrlString,'http://share-links.biz/_','',[rfIgnoreCase]); 

Result:= False; 
  Http := TIdHttp.Create(nil); 
  try 
    Http.HandleRedirects := True; 
    Http.RedirectMaximum := 5; 
    Http.CookieManager := idckmngr1; 
    Http.AllowCookies:=True; 
    HTTP.Request.UserAgent := 'Opera/9.80 (Windows NT 6.1; U; de) Presto/2.5.22 Version/10.51' ; 
    HTTP.Request.Accept := 'text/html, */*'; 
    sList:= TStringList.Create; 
    try 
    sList.Add('user' + aEinstellungen[22]); 
    sList.Add('pass' + aEinstellungen[23]); 
      try 
        s1:=Http.Post('http://share-links.biz/login',sList); 
       except 
       mmo1.Lines.Add('fehler in 1'); 
       Exit; 
      end; 
      finally 
    sList.Free; 
    end; 

    try 
      s2:=Http.Get('http://share-links.biz/manage?search=' + UrlString); 
      if TRegEx.IsMatch(s2,'name\=.chkFolder\[\]. value\=.[\d]*\"') then 
         begin 
          match := TRegEx.Match(s2, 'name\=.chkFolder\[\]. value\=.[\d]*\"'); 
          match := TRegEx.Match(match.Value, '[\d]*'); 
         end; 

    except 
      mmo1.Lines.Add('fehler in 2'); 
      Exit; 
    end; 
    sList:= TStringList.Create; 
    try 
      sList.Add('op=stimg_png'); 
      sList.Add('chkFolder[]=' + match.Value)  ; 


      try 
        s2:=Http.Post('http://share-links.biz/manage?search=' + UrlString,Daten); 
        match := TRegEx.Match(s2, 'http\:\/\/stats\.share\-links\.biz\/[\w]*\.png'); 
        Result:= True; 
      except 
       on e: Exception do 
        begin 
          mmo1.Lines.Add(e.message); 
          mmo1.Lines.Add('fehler in 3'); 
          Exit; 
        end; 
      end; 
    if TRegEx.IsMatch(s2,'Es wurden keine geschützen Ordner gefunden') then 
      begin 
       mmo1.Lines.Add('Fehler durch ShareLinks kein Ordner gefunden') ; 
       if TRegEx.IsMatch(s2,'Sie sind eingeloggt als') then mmo1.Lines.Add('Loggin scheint OK') 
       else mmo1.Lines.Add('Loggin ist eventuell falsch') ; 
      end; 
     finally 
     sList.Free; 
    end; 
  finally 
    Http.Free; 
  end; 
  aResultPic:= match.Value;  