Create table User (
    id int auto_increment,
    email VARCHAR(100),
    lastName VARCHAR(50),
    firstName VARCHAR(50),
    address VARCHAR(50),
    phoneNumber VARCHAR(10),
    dateOfBirth DATE,
    PRIMARY KEY (id)
);



Create table Comment(
    id int,
    title VARCHAR(50),
    content VARCHAR(500),
    created_at DATETIME,
    updated_at DATETIME,
    postedBy int,
    game INT,
    PRIMARY KEY (id),
    FOREIGN KEY (game) references Game(id),
    FOREIGN KEY (postedBy) references User(id)
)