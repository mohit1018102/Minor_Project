import matplotlib
import numpy as np #for array operations
from sklearn import model_selection # spliting the data (80,20)

import pandas  #used toread csv file 

from sklearn.metrics import classification_report
from sklearn.metrics import confusion_matrix
from sklearn.metrics import accuracy_score

'''------------------ALGORITHMS---------------------'''
from sklearn.linear_model import LogisticRegression
from sklearn.tree import DecisionTreeClassifier
from sklearn.neighbors import KNeighborsClassifier
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis
from sklearn.naive_bayes import GaussianNB
from sklearn.svm import SVC


print("-------------STARTING-----------------\n")

names=['sepal-length','sepal-width','petal-length','petal-width','class']

dataset=pandas.read_csv('./iris.csv',names=names)
print(f"\n----------classes-----------\n {dataset.groupby('class').size()}\n---------------------------\n")
#print(dataset)
#split-out validation or test data (80% training data) /(20% test data)

array=dataset.values
x=array[:,0:4]
y=array[:,4]

validation_size=0.20 #20%
seed=7

scoring='accuracy'

#it splits the data into two sets training set(which is used to train the model) and test data(which is used to check or measure the accuracy of the model)
x_train, x_test, y_train, y_test=model_selection.train_test_split(x,y,test_size=validation_size,random_state=seed) 


#ALGORITHMS

models=[] #empty list
models.append(('LR',LogisticRegression(solver='liblinear',multi_class='ovr')))
models.append(('LDA',LinearDiscriminantAnalysis()))
models.append(('KNN',KNeighborsClassifier()))
models.append(('CART',DecisionTreeClassifier()))
models.append(('NB',GaussianNB()))
models.append(('SVM',SVC(gamma='auto')))

results=[]
names=[]

for name,model in models:
	'''kfold : Provides train/test indices to split data in train/test 
	sets. Split dataset into k consecutive folds (without shuffling by default).
    Each fold is then used once as a validation while the k - 1
     remaining folds form the training set.'''
	kfold=model_selection.KFold(n_splits=10,random_state=seed)
	cv_results=model_selection.cross_val_score(model, x_train,y_train,cv=kfold,scoring=scoring)
	results.append(cv_results)
	names.append(name)
	print(f"{name} : {cv_results.mean()*100}%")


print("-----------------using seperately---------------------")
knn=KNeighborsClassifier()
knn.fit(x_train,y_train)
predictions=knn.predict(x_test)

print(str(accuracy_score(y_test,predictions)*100)+" %")
print(confusion_matrix(y_test,predictions))
print(classification_report(y_test,predictions))


print("\n-------------------ENTER ATTRIBUTES(prediction using SVC)-----------------------\n")

sepallength=float(input("Enter sepal-length : "))
sepalwidth=float(input("Enter sepal-width : "))
petallength=float(input("Enter petal-length : "))
petalwidth=float(input("Enter petal-width : "))

input_data=np.array([sepallength,sepalwidth,petallength,petalwidth])
input_data=input_data.reshape(1,-1)

svm_model=SVC(gamma='auto')
svm_model.fit(x_train,y_train)

predictions=svm_model.predict(input_data)
print("\n--------------------------------\n")
print(f"class : {predictions[0]}")
print("\n--------------------------------\n")