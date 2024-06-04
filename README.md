
# Post Rest Api


Bu proje, Users ve Posts verilerini içeren iki farklı API endpoint'lerindeki verileri çekerek DB'ye kaydeden bir REST API servisidir.

Proje PHP Slim Framework'ü kullanılarak geliştirildi.

GetDataFromRestApiIntoDatabase.php adındaki dosya çalıştırıldığında Endpoint'lerdeki datalar alınarak DB'ye ekleniyor.

MySQL kullanıldı. Veritabanı dosyası ana dizinde bulunmaktadır.


#### Kullanım

```http
  GET /api/posts
```

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
|  | | **Post**  verilerini listeleyen servis. |


```http
  POST /api/posts/create/
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
|       | | Post verilerini oluşturan servis. |

```http
  POST /api/users/create/
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
|       | | User verilerini oluşturan servis. |

  
```http
  DELETE /api/posts/delete/{id}
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
|  `id`   | integer| **Gerekli**. Post verisini silen servis. |


## Ekran Görüntüleri

![Post Dashboard](/public/Screenshots/Screenshot_2.png)

![Post Dashboard](/public/Screenshots/Screenshot_3.png)

![Post Dashboard](/public/Screenshots/Screenshot_4.png)

![Post Dashboard](/public/Screenshots/Screenshot_5.png)

![Post Dashboard](/public/Screenshots/Screenshot_6.png)

![Post Dashboard](/public/Screenshots/Screenshot_7.png)
