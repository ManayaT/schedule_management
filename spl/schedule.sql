-- webReport_01以下に「scheduleテーブル」と「userテーブル」を作成してください．
DROP TABLE IF EXISTS schedule;
CREATE TABLE schedule (
    id INT NOT NULL AUTO_INCREMENT,
    begin DATETIME NOT NULL,
    end DATETIME NOT NULL,
    place TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    content TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    PRIMARY KEY (id)
);