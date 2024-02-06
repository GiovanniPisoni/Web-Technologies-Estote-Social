-- Inserimento dati per la tabella UTENTE
INSERT INTO UTENTE (Nome, Cognome, DataDiNascita, ImmagineProfilo, GruppoAppartenenza, Mail, Username, Password, Bio, Fazzolettone, Specialita, Totem)
VALUES 
  ('Giacomo', 'Foschi', '2002-03-02', 'profiloGiacomo.jpg', 'Cesena6', 'giakyfoschi@gmail.com', 'giaky_ilNano', 'password', 'Appassionato di outdoor, insegnante di musica', 'fazzolettoneGiacomo.jpg', 'specialitaGiacomo.jpg', 'Dingo Loquace'),
  ('Giovanni', 'Rinchiuso', '2002-02-15', 'profiloGino.jpg', 'Ravenna4', 'rinchiusog8@gmail.com', 'gino_ilGrande', 'password', 'Amante della cucina italiana', 'fazzolettoneGino.jpg', 'specialitaGino.jpg', 'Daino Pacifico'),
  ('Giovanni', 'Pisoni', '2002-05-30', 'profiloPiso.jpg', NULL, 'giovapison@gmail.com', 'piso_ilPacioccone', 'password', 'Io non volevo essere qui, mi hanno obbligato', NULL, NULL, NULL);

-- Inserimento dati per la tabella POST
INSERT INTO POST (Testo, hashtag1, hashtag2, hashtag3, Immagine, Username, Data)
VALUES 
('Accompagnando mia nonna ad attraversare la strada mi hanno dato una specialità, sono un bimbo bravo', '#nonna', '#buonaazione', '#scout', 'postGiacomo.jpg', 'giaky_ilNano', '2024-01-17'),
('Organizzazione per il prossimo anno per la Co.Ca. del Ravenna 4', '#scout', '#coca', '#Ravenna4', "postGino.png", 'gino_ilGrande', '2024-01-16'),
('Come si esce da questo social?', '#hater', '#aiutatemi', NULL, NULL, 'piso_ilPacioccone', '2024-01-15');
('Risveglio in dolomiti', '#natura', '#sunrise', NULL, 'post2Gino.jpg', 'gino_ilGrande', '2024-02-10');
('Apri la tenda e trovi questo... Nasseto posto del cuore', '#camping', '#natura', '#ferrino', 'post2Giacomo.jpg', 'giaky_ilNano', '2024-02-11');