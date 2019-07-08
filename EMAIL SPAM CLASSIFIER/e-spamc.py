import pandas as pd
import numpy as np

from sklearn import preprocessing,model_selection,svm
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.model_selection import GridSearchCV
data=pd.read_csv("spam.csv",encoding='latin-1')
x=data['text']
y=data['class']


x_train,x_test,y_train,y_test=model_selection.train_test_split(x,y,test_size=0.20,random_state=0)

cv=CountVectorizer()
features=cv.fit_transform(x_train)
tuned_parameters={'kernel':['linear','rbf'],'gamma':[1e-3,1e-4],
'C':[1,10,100,1000]}
model=GridSearchCV(svm.SVC(gamma='auto'),tuned_parameters)
model.fit(features,y_train)

features_test=cv.transform(x_test)
accuracy=model.score(features_test,y_test)
print(f"accuracy : {accuracy} %")